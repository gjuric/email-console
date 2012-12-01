<?php

namespace Ccentar\Service;

use Doctrine\DBAL\Connection;
use PDO;

/**
 * Domain Service
 *
 * @author Goran Jurić
 */
class AmavisService
{
    /**
     * Database Connection
     *
     * @var Doctrine\DBAL\Connection
     */
    private $conn;

    /**
     * Constructor
     */
    public function __construct(Connection $conn = null)
    {
        if (is_null($conn)) {
            $doctrine = \Zend_Registry::get('doctrine');
            $this->conn = $doctrine->getConnection('amavis');
        } else {
            $this->conn = $conn;
        }
    }


    /**
     * Get Number of Latest Message
     *
     * Return the number of messages so we can build a paginator.
     * @return integer
     */
    private function getLatestCount()
    {
        $query = "SELECT count(*) as num_of_records FROM msgs";
        return $this->conn->fetchColumn($query);
    }

    /**
     * Get Last Messages
     *
     * @param $limit
     * @return array
     */
    public function getLatest($page = 1, $perPage = 25)
    {
        $offset = ($page - 1) * $perPage;

        $query = "SELECT
            UNIX_TIMESTAMP()-msgs.time_num AS age, time_iso, time_num, policy as policy,
            content, dsn_sent as dsn_sent, ds as delivery_status, bspam_level AS spam_level, size,
            sender.email AS sender,
            recip.email  AS recipient,
            msgs.subject AS subject
            FROM msgs LEFT JOIN msgrcpt         ON msgs.mail_id=msgrcpt.mail_id
                        LEFT JOIN maddr AS sender ON msgs.sid=sender.id
                        LEFT JOIN maddr AS recip  ON msgrcpt.rid=recip.id
            WHERE content IS NOT NULL
            ORDER BY msgs.time_num DESC LIMIT " . (int) $perPage . " OFFSET $offset";

        return $this->conn->executeQuery("$query")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get Paginator for Latest Mail
     *
     * @param integer $currentPage
     * @param integer $perPage
     * @return \Zend_paginator
     */
    public function getLatestPaginator($currentPage, $perPage = 25)
    {
        $adapter = new \Zend_Paginator_Adapter_Null($this->getLatestCount());

        $paginator = new \Zend_Paginator($adapter);
        $paginator->setCurrentPageNumber($currentPage);
        $paginator->setItemCountPerPage($perPage);

        return $paginator;
    }

    /**
     * Get Messages with highest SPAM score
     *
     * @param integer $limit
     * @return array
     */
    public function topSpam($limit = 25)
    {
        $query = "SELECT count(*) as cnt, avg(bspam_level), sender.domain
            FROM msgs
            LEFT JOIN msgrcpt ON msgs.mail_id=msgrcpt.mail_id
            LEFT JOIN maddr AS sender ON msgs.sid=sender.id
            LEFT JOIN maddr AS recip ON msgrcpt.rid=recip.id
            WHERE content IN ('V', 's', 'S', 'B')
            GROUP BY sender.domain ORDER BY cnt DESC LIMIT " . (int) $limit;

        return $this->conn->executeQuery($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get Messages with lowest SPAM score
     *
     * @param integer $limit
     * @return array
     */
    public function topHam($limit = 25)
    {
        $query = "SELECT count(*) as cnt, avg(bspam_level) as spam_avg, sender.domain
            FROM msgs
            LEFT JOIN msgrcpt ON msgs.mail_id=msgrcpt.mail_id
            LEFT JOIN maddr AS sender ON msgs.sid=sender.id
            LEFT JOIN maddr AS recip ON msgrcpt.rid=recip.id
            WHERE bspam_level IS NOT NULL
            GROUP BY sender.domain HAVING count(*) > 5
            ORDER BY spam_avg DESC LIMIT " . (int) $limit;
        return $this->conn->executeQuery($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get Top Senders
     *
     * @param integer $limit
     * @return array
     */
    public function topSenders($limit = 25)
    {
        $query = "SELECT count(*) as cnt, avg(bspam_level) as spam_avg, sender.domain
            FROM msgs
            LEFT JOIN msgrcpt ON msgs.mail_id=msgrcpt.mail_id
            LEFT JOIN maddr AS sender ON msgs.sid=sender.id
            LEFT JOIN maddr AS recip ON msgrcpt.rid=recip.id
            GROUP BY sender.domain HAVING count(*) > 100
            ORDER BY sender.domain DESC LIMIT " . (int) $limit;
        return $this->conn->executeQuery($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get list of mails in Quarantine
     *
     * @return array
     */
    public function quarantineList()
    {
        $query = "SELECT *
            FROM quarantine q
            LEFT JOIN msgs on msgs.mail_id = q.mail_id
            LEFT JOIN msgrcpt ON msgrcpt.mail_id = msgs.mail_id";
        return $this->conn->executeQuery($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
