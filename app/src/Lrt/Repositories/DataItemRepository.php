<?php

namespace Lrt\Repositories;

use Doctrine\ORM\EntityRepository;

class DataItemRepository extends EntityRepository
{
    private function runSql($sql)
    {
        $statement = $this->getEntityManager()->getConnection()->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getAnchorsTextGrouped()
    {
        $sql = <<<'SQL'
        SELECT 
          COUNT(*) AS count, 
          lower(anchor_text) AS item                       
        FROM data_item
        GROUP BY lower(anchor_text)
SQL;

        return $this->runSql($sql);
    }

    public function getLinkStatusGrouped()
    {
        $sql = <<<'SQL'
        SELECT 
          COUNT(*) AS count, 
          link_status AS item                        
        FROM data_item
        GROUP BY link_status
SQL;

        return $this->runSql($sql);
    }

    public function getFromUrlGroupedByHost()
    {
        $sql = <<<'SQL'
        SELECT 
          COUNT(*) AS count,
          SUBSTRING_INDEX(
            REPLACE(
              REPLACE(
                REPLACE(
                  from_url, 
                  'http://' , ''
                ), 
                'https://', ''
              ),
              'www.', ''
            ),
            '/', 1
          ) AS host                                  
        FROM data_item
        GROUP BY host
SQL;

        return $this->runSql($sql);
    }

    public function getBLDomGroupedByRange()
    {
        $sql = <<<'SQL'
        SELECT 
          SUM(IF(bldom = 0, 1, 0)) AS r0,
          SUM(IF(1 <= bldom AND bldom <= 10, 1, 0)) AS r1,
          SUM(IF(11 <= bldom AND bldom <= 100, 1, 0)) AS r2,
          SUM(IF(bldom <= 1000, 1, 0)) AS r3,
          SUM(IF(bldom <= 10000, 1, 0)) AS r4,
          SUM(IF(bldom <= 100000, 1, 0)) AS r5,
          SUM(IF(bldom >= 100000, 1, 0)) AS r6
        FROM data_item
SQL;

        return $this->runSql($sql);
    }
}