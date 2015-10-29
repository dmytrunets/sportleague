<?php
namespace AppBundle\Command;

use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SimpleDataCommand extends ContainerAwareCommand
{
    const COUNT_TEAM = 10;
    const COUNT_PLAYER = 100;
    const COUNT_TOURNAMENT = 5;

    const STRATEGY_CROSS_LINK = 1;
    const STRATEGY_UNIQUE = 2;

    const TOURNAMENT_STRATEGY_TYPE_CROSS = 1;
    const TOURNAMENT_STRATEGY_TYPE_PLAYOFF = 2;


    /** @var  ManagerRegistry */
    protected $doctrine;

    protected $showSql = true;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('project:simple-data:run')
            ->setDescription('Fill testing data');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Hello world");

        $this->doctrine = $this->getContainer()->get('doctrine');

        $this->clear();

        $desc = array(
            'player'             => array(
                'name'          => 'Player #%d',
                'birthday'      => '1990-09-09'
            ),
            'team'               => array(
                'name'          => 'Team #%d',
                'address_id'    => '%d'
            ),
            'game'               => array(
                'tournament_id'     => '%d',
                'organizer_team_id' => '%d',
                'guest_team_id'     => '%d',
                'stadium_id'        => '%d',
                'time'              => '2015-10-21 12:00:00',
                'score'             => '- : -',
            ),
            'stadium'            => array(
                'location' => '50.433406, 30.521831',
                'title'    => 'Stadium #%d'
            ),
            'tournament'        => array(
                'title'        => 'Tournament #%d',
                'start_date'   => '2015-10-21 12:00:00',
                'finish_date'  => '2015-10-21 12:00:00',
                'count_player' => 5,
                'game_time'    => 90
            ),
            'team_to_tournament' => array('team_id' => '%d', 'tournament_id' => '%d'),
            'player_to_team'     => array('player_id' => '%d', 'team_id' => '%d'),
            'stadium_to_team'    => array('stadium_id' => '%d', 'team_id' => '%d'),
            'location_country'   => array('name' => 'Ukraine'),
            'location_region'    => array('location_country_id' => 1, 'name' => 'Kiev'),
            'location_city'      => array('location_country_id' => 1, 'location_region_id' => 1, 'name' => 'Kiev'),
            'location_address'   => array(
                'location_country_id'  => 1,
                'location_region_id'   => 1,
                'location_city_id'     => 1
            )
        );

        for ($i = 1; $i <= self::COUNT_TOURNAMENT; $i++) {
            $this->generateGames('game', $desc['game'], self::TOURNAMENT_STRATEGY_TYPE_CROSS, self::COUNT_TEAM, $i);
        }

        $this->insert('stadium', $desc['stadium'], self::COUNT_TEAM);
        $this->insert('team', $desc['team'], self::COUNT_TEAM);
        $this->insert('player', $desc['player'], self::COUNT_PLAYER);
        $this->insert('tournament', $desc['tournament'], self::COUNT_TOURNAMENT);

        $this->insert('location_country', $desc['location_country'], 1);
        $this->insert('location_region', $desc['location_region'], 1);
        $this->insert('location_city', $desc['location_city'], 1);
        $this->insert('location_address', $desc['location_address'], self::COUNT_TEAM);

        $this->linkedTable(
            'team_to_tournament', $desc['team_to_tournament'], self::COUNT_TEAM, self::COUNT_TOURNAMENT,
            self::STRATEGY_CROSS_LINK
        );
        $this->linkedTable(
            'player_to_team', $desc['player_to_team'], self::COUNT_PLAYER, self::COUNT_TEAM, self::STRATEGY_UNIQUE
        );

        $this->linkedTable(
            'stadium_to_team', $desc['stadium_to_team'], self::COUNT_TEAM, self::COUNT_TEAM, self::STRATEGY_UNIQUE
        );
    }

    /**
     * @param string $tableName
     * @param array $desc
     * @param int $strategy
     * @param int $teams
     * @param int $tournament_id
     *
     * @throws \Exception
     */
    protected function generateGames($tableName, array $desc, $strategy, $teams, $tournament_id) {
        if ($strategy == self::TOURNAMENT_STRATEGY_TYPE_CROSS) {
            $rows = array();

            for ($i = 1; $i <= $teams; $i++) {
                for ($j = 1; $j <= $teams; $j++) {
                    if ($i !== $j) {
                        $replaced = array(
                            'tournament_id'     => $tournament_id,
                            'organizer_team_id' => $i,
                            'guest_team_id'     => $j,
                            'stadium_id'        => $i
                        );

                        $diff = array_diff_key($replaced, $desc);
                        foreach ($diff as $key => $val) {
                            unset($replaced[$key]);
                        }

                        $values = array_merge($desc, $replaced);
                        $rows[] = sprintf('("%s")', implode('", "', $values));
                    }
                }
            }

            $sql = sprintf("INSERT INTO %s (%s) VALUES \n %s;",
                    $tableName,
                    implode(', ', array_keys($desc)),
                    implode(",\n", $rows)
                );

            $this->addSql($sql);
        } elseif ($strategy == self::TOURNAMENT_STRATEGY_TYPE_PLAYOFF) {
            throw new \Exception('Not implemented');
        }
    }

    /**
     * Insert into table n values
     *
     * @param string $tableName Name of table
     * @param array  $desc      Fields and value with patters for replacing
     * @param int    $count
     */
    protected function insert($tableName, array $desc, $count)
    {
        $rows = array();
        for ($i = 1; $i <= $count; $i++) {
            $rows[] = sprintf('("%s")',
                implode('", "', array_values($this->prepare($desc, $i)))
            );
        }

        $sql = sprintf('INSERT INTO %s (%s) VALUES %s;', $tableName, implode(', ', array_keys($desc)), implode(",\n", $rows));
        $this->addSql($sql);
    }

    /**
     * @param string $tableName
     * @param array  $desc
     * @param int    $entityA
     * @param int    $entityB
     * @param int    $strategyType
     */
    protected function linkedTable($tableName, array $desc, $entityA, $entityB, $strategyType)
    {
        if ($strategyType == self::STRATEGY_CROSS_LINK) {
            $this->crossInsertIntoLinkedTable($tableName, $desc, $entityA, $entityB);
        }

        if ($strategyType == self::STRATEGY_UNIQUE) {
            $this->uniqueInsertInLinkedTable($tableName, $desc, $entityA, $entityB);
        }
    }

    /**
     * Insert into linked table by CROSS strategy
     * One Team in many Tournaments
     *
     * @param       $tableName
     * @param array $desc
     * @param       $team
     * @param       $tournament
     */
    protected function crossInsertIntoLinkedTable($tableName, array $desc, $team, $tournament)
    {
        $rows = array();
        for ($i = 1; $i <= $team; $i++) {
            if (!$this->showSQL()) {
                echo "\n------------------------------";
                echo "\nTeam #" . $i;
            }
            for ($j = 1; $j <= $tournament; $j++) {
                if (!$this->showSQL()) {
                    echo "\n\t Tournament #" . $j;
                }

                $rows[] = sprintf('(%d, %d)', $i, $j);
            }
        }

        $sql = sprintf("INSERT INTO %s (%s) VALUES \n %s;", $tableName, implode(', ', array_keys($desc)), implode(",\n", $rows));
        $this->addSql($sql);
    }

    /**
     * Insert UNIQUE strategy
     * One Player in one Team
     *
     * @param       $tableName
     * @param array $desc
     * @param       $player
     * @param       $team
     */
    protected function uniqueInsertInLinkedTable($tableName, array $desc, $player, $team)
    {
        $rows = array();
        $players_in_team = $player / $team;

        $player_i = 1;
        for ($i = 1; $i <= $team; $i++) {
            if (!$this->showSQL()) {
                echo "\n------------------------------";
                echo "\nTeam #" . $i;
            }

            for ($j = 1; $j <= $players_in_team; $j++) {
                if (!$this->showSQL()) {
                    echo "\n\tPlayer #" . $player_i;
                }

                $rows[] = sprintf('(%d, %d)', $player_i, $i);

                $player_i++;
            }
        }

        $sql = sprintf("INSERT INTO %s (%s) VALUES \n %s;", $tableName, implode(', ', array_keys($desc)), implode(",\n", $rows));
        $this->addSql($sql);
    }

    public function showSQL()
    {
        return $this->showSql;
    }

    /**
     * Prepare unique data parse id
     *
     * @param array   $desc
     * @param integer $id
     *
     * @return array
     */
    protected function prepare(array $desc, $id)
    {
        $result = array();
        foreach ($desc as $key => $value) {
            $result[$key] = sprintf($value, $id);
        }

        return $result;
    }

    /**
     * Execute sql
     *
     * @param string $sql
     */
    protected function addSql($sql)
    {
        if ($this->showSQL()) {
            echo "\n$sql";
        }
        $this->doctrine->getManager()->getConnection()->prepare($sql)->execute();
    }

    /**
     * Truncate all tables
     */
    protected function clear()
    {
        $tables = array(
            'game',
            'game_status',
            'player',
            'player_to_team',
            'stadium',
            'stadium_to_team',
            'team',
            'team_to_tournament',
            'tournament',
            'location_address',
            'location_region',
            'location_country',
            'location_city',
        );

        foreach ($tables as $table) {
            $this->addSql(sprintf("TRUNCATE %s", $table));
        }
    }
} 
