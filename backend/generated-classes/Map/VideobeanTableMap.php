<?php

namespace Map;

use \Videobean;
use \VideobeanQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'VideoBean' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class VideobeanTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.VideobeanTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'VideoBean';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Videobean';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Videobean';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the Id field
     */
    const COL_ID = 'VideoBean.Id';

    /**
     * the column name for the Codigo field
     */
    const COL_CODIGO = 'VideoBean.Codigo';

    /**
     * the column name for the Marca field
     */
    const COL_MARCA = 'VideoBean.Marca';

    /**
     * the column name for the Modelo field
     */
    const COL_MODELO = 'VideoBean.Modelo';

    /**
     * the column name for the Especificaciones field
     */
    const COL_ESPECIFICACIONES = 'VideoBean.Especificaciones';

    /**
     * the column name for the Accesorios field
     */
    const COL_ACCESORIOS = 'VideoBean.Accesorios';

    /**
     * the column name for the Estado field
     */
    const COL_ESTADO = 'VideoBean.Estado';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Codigo', 'Marca', 'Modelo', 'Especificaciones', 'Accesorios', 'Estado', ),
        self::TYPE_CAMELNAME     => array('id', 'codigo', 'marca', 'modelo', 'especificaciones', 'accesorios', 'estado', ),
        self::TYPE_COLNAME       => array(VideobeanTableMap::COL_ID, VideobeanTableMap::COL_CODIGO, VideobeanTableMap::COL_MARCA, VideobeanTableMap::COL_MODELO, VideobeanTableMap::COL_ESPECIFICACIONES, VideobeanTableMap::COL_ACCESORIOS, VideobeanTableMap::COL_ESTADO, ),
        self::TYPE_FIELDNAME     => array('Id', 'Codigo', 'Marca', 'Modelo', 'Especificaciones', 'Accesorios', 'Estado', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Codigo' => 1, 'Marca' => 2, 'Modelo' => 3, 'Especificaciones' => 4, 'Accesorios' => 5, 'Estado' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'codigo' => 1, 'marca' => 2, 'modelo' => 3, 'especificaciones' => 4, 'accesorios' => 5, 'estado' => 6, ),
        self::TYPE_COLNAME       => array(VideobeanTableMap::COL_ID => 0, VideobeanTableMap::COL_CODIGO => 1, VideobeanTableMap::COL_MARCA => 2, VideobeanTableMap::COL_MODELO => 3, VideobeanTableMap::COL_ESPECIFICACIONES => 4, VideobeanTableMap::COL_ACCESORIOS => 5, VideobeanTableMap::COL_ESTADO => 6, ),
        self::TYPE_FIELDNAME     => array('Id' => 0, 'Codigo' => 1, 'Marca' => 2, 'Modelo' => 3, 'Especificaciones' => 4, 'Accesorios' => 5, 'Estado' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('VideoBean');
        $this->setPhpName('Videobean');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Videobean');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('Id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('Codigo', 'Codigo', 'LONGVARCHAR', false, null, null);
        $this->addColumn('Marca', 'Marca', 'LONGVARCHAR', false, null, null);
        $this->addColumn('Modelo', 'Modelo', 'LONGVARCHAR', false, null, null);
        $this->addColumn('Especificaciones', 'Especificaciones', 'LONGVARCHAR', false, null, null);
        $this->addColumn('Accesorios', 'Accesorios', 'LONGVARCHAR', false, null, null);
        $this->addColumn('Estado', 'Estado', 'LONGVARCHAR', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? VideobeanTableMap::CLASS_DEFAULT : VideobeanTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Videobean object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = VideobeanTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VideobeanTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VideobeanTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VideobeanTableMap::OM_CLASS;
            /** @var Videobean $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VideobeanTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = VideobeanTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VideobeanTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Videobean $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VideobeanTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(VideobeanTableMap::COL_ID);
            $criteria->addSelectColumn(VideobeanTableMap::COL_CODIGO);
            $criteria->addSelectColumn(VideobeanTableMap::COL_MARCA);
            $criteria->addSelectColumn(VideobeanTableMap::COL_MODELO);
            $criteria->addSelectColumn(VideobeanTableMap::COL_ESPECIFICACIONES);
            $criteria->addSelectColumn(VideobeanTableMap::COL_ACCESORIOS);
            $criteria->addSelectColumn(VideobeanTableMap::COL_ESTADO);
        } else {
            $criteria->addSelectColumn($alias . '.Id');
            $criteria->addSelectColumn($alias . '.Codigo');
            $criteria->addSelectColumn($alias . '.Marca');
            $criteria->addSelectColumn($alias . '.Modelo');
            $criteria->addSelectColumn($alias . '.Especificaciones');
            $criteria->addSelectColumn($alias . '.Accesorios');
            $criteria->addSelectColumn($alias . '.Estado');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(VideobeanTableMap::DATABASE_NAME)->getTable(VideobeanTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(VideobeanTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(VideobeanTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new VideobeanTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Videobean or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Videobean object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideobeanTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Videobean) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VideobeanTableMap::DATABASE_NAME);
            $criteria->add(VideobeanTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = VideobeanQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VideobeanTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VideobeanTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the VideoBean table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return VideobeanQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Videobean or Criteria object.
     *
     * @param mixed               $criteria Criteria or Videobean object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideobeanTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Videobean object
        }


        // Set the correct dbName
        $query = VideobeanQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // VideobeanTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
VideobeanTableMap::buildTableMap();
