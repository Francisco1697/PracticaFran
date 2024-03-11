<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class Doctrine {

    public EntityManager $em;

    public function __construct()
    {
        $paths = ['/models/Entities'];
        $isDevMode = false;
    
        $dbParams = [
            'driver'   => 'pdo_mysql',
            'user'     => 'ingenieria',
            'password' => 'V22+PUa+ijJL5hamfjubCwreXBUJ57n0IFTGvA0QYFygXgVc',
            'host'     => 'db-development.cbq3cbjddsma.us-east-1.rds.amazonaws.com',
            'dbname'   => 'Base_Francisco',
        ];
        
        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
        $connection = DriverManager::getConnection($dbParams, $config);  
        $this->em =new EntityManager($connection, $config);      
    }
}