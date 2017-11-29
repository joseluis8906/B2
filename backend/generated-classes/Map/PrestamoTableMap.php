<?php

namespace Map;

use \Prestamo;
use \PrestamoQuery;
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
 * This class defines the structure of the 'Prestamo' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PrestamoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PrestamoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Prestamo';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Prestamo';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Prestamo';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the Id field
     */
    const COL_ID = 'Prestamo.Id';

    /**
     * the column name for the UsuarioId field
     */
    const COL_USUARIOID = 'Prestamo.UsuarioId';

    /**
     * the column name for the LibroId field
     */
    const COL_LIBROID = 'Prestamo.LibroId';

    /**
     * the column name for the VideoBeanId field
     */
    const COL_VIDEOBEANID = 'Prestamo.VideoBeanId';

    /**
     * the column name for the TablaDibujoId field
     */
    const COL_TABLADIBUJOID = 'Prestamo.TablaDibujoId';

    /**
     * the column name for the FechaReserva field
     */
    const COL_FECHARESERVA = 'Prestamo.FechaReserva';

    /**
     * the column name for the FechaPrestamo field
     */
    const COL_FECHAPRESTAMO = 'Prestamo.FechaPrestamo';

    /**
     * the column name for the FechaDevolucion field
     */
    const COL_FECHADEVOLUCION = 'Prestamo.FechaDevolucion';

    /**
     * the column name for the Estado field
     */
    const COL_ESTADO = 'Prestamo.Estado';

    /**
     * the column name for the Sancion field
     */
    const COL_SANCION = 'Prestamo.Sancion';

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
        self::TYPE_PHPNAME       => array('Id', 'UsuarioId', 'LibroId', 'VideoBeanId', 'TablaDibujoId', 'FechaReserva', 'FechaPrestamo', 'FechaDevolucion', 'Estado', 'Sancion', ),
        self::TYPE_CAMELNAME     => array('id', 'usuarioId', 'libroId', 'videoBeanId', 'tablaDibujoId', 'fechaReserva', 'fechaPrestamo', 'fechaDevolucion', 'estado', 'sancion', ),
        self::TYPE_COLNAME       => array(PrestamoTableMap::COL_ID, PrestamoTableMap::COL_USUARIOID, PrestamoTableMap::COL_LIBROID, PrestamoTableMap::COL_VIDEOBEANID, PrestamoTableMap::COL_TABLADIBUJOID, PrestamoTableMap::COL_FECHARESERVA, PrestamoTableMap::COL_FECHAPRESTAMO, PrestamoTableMap::COL_FECHADEVOLUCION, PrestamoTableMap::COL_ESTADO, PrestamoTableMap::COL_SANCION, ),
        self::TYPE_FIELDNAME     => array('Id', 'UsuarioId', 'LibroId', 'VideoBeanId', 'TablaDibujoId', 'FechaReserva', 'FechaPrestamo', 'FechaDevolucion', 'Estado', 'Sancion', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'UsuarioId' => 1, 'LibroId' => 2, 'VideoBeanId' => 3, 'TablaDibujoId' => 4, 'FechaReserva' => 5, 'FechaPrestamo' => 6, 'FechaDevolucion' => 7, 'Estado' => 8, 'Sancion' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'usuarioId' => 1, 'libroId' => 2, 'videoBeanId' => 3, 'tablaDibujoId' => 4, 'fechaReserva' => 5, 'fechaPrestamo' => 6, 'fechaDevolucion' => 7, 'estado' => 8, 'sancion' => 9, ),
        self::TYPE_COLNAME       => array(PrestamoTableMap::COL_ID => 0, PrestamoTableMap::COL_USUARIOID => 1, PrestamoTableMap::COL_LIBROID => 2, PrestamoTableMap::COL_VIDEOBEANID => 3, PrestamoTableMap::COL_TABLADIBUJOID => 4, PrestamoTableMap::COL_FECHARESERVA => 5, PrestamoTableMap::COL_FECHAPRESTAMO => 6, PrestamoTableMap::COL_FECHADEVOLUCION => 7, PrestamoTableMap::COL_ESTADO => 8, PrestamoTableMap::COL_SANCION => 9, ),
        self::TYPE_FIELDNAME     => array('Id' => 0, 'UsuarioId' => 1, 'LibroId' => 2, 'VideoBeanId' => 3, 'TablaDibujoId' => 4, 'FechaReserva' => 5, 'FechaPrestamo' => 6, 'FechaDevolucion' => 7, 'Estado' => 8, 'Sancion' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('Prestamo');
        $this->setPhpName('Prestamo');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Prestamo');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('Id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('UsuarioId', 'UsuarioId', 'INTEGER', 'Usuario', 'Id', false, null, null);
        $this->addForeignKey('LibroId', 'LibroId', 'INTEGER', 'Libro', 'Id', false, null, null);
        $this->addForeignKey('VideoBeanId', 'VideoBeanId', 'INTEGER', 'VideoBean', 'Id', false, null, null);
        $this->addForeignKey('TablaDibujoId', 'TablaDibujoId', 'INTEGER', 'TablaDibujo', 'Id', false, null, null);
        $this->addColumn('FechaReserva', 'FechaReserva', 'DATE', false, null, null);
        $this->addColumn('FechaPrestamo', 'FechaPrestamo', 'DATE', false, null, null);
        $this->addColumn('FechaDevolucion', 'FechaDevolucion', 'DATE', false, null, null);
        $this->addColumn('Estado', 'Estado', 'LONGVARCHAR', false, null, null);
        $this->addColumn('Sancion', 'Sancion', 'DECIMAL', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TablaDibujo', '\\TablaDibujo', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':TablaDibujoId',
    1 => ':Id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('VideoBean', '\\VideoBean', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':VideoBeanId',
    1 => ':Id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('Libro', '\\Libro', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':LibroId',
    1 => ':Id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('Usuario', '\\Usuario', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':UsuarioId',
    1 => ':Id',
  ),
), 'CASCADE', 'CASCADE', null, false);
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
        return $withPrefix ? PrestamoTableMap::CLASS_DEFAULT : PrestamoTableMap::OM_CLASS;
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
     * @return array           (Prestamo object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PrestamoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PrestamoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PrestamoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PrestamoTableMap::OM_CLASS;
            /** @var Prestamo $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PrestamoTableMap::addInstanceToPool($obj, $key);
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
            $key = PrestamoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PrestamoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Prestamo $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PrestamoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PrestamoTableMap::COL_ID);
            $criteria->addSelectColumn(PrestamoTableMap::COL_USUARIOID);
            $criteria->addSelectColumn(PrestamoTableMap::COL_LIBROID);
            $criteria->addSelectColumn(PrestamoTableMap::COL_VIDEOBEANID);
            $criteria->addSelectColumn(PrestamoTableMap::COL_TABLADIBUJOID);
            $criteria->addSelectColumn(PrestamoTableMap::COL_FECHARESERVA);
            $criteria->addSelectColumn(PrestamoTableMap::COL_FECHAPRESTAMO);
            $criteria->addSelectColumn(PrestamoTableMap::COL_FECHADEVOLUCION);
            $criteria->addSelectColumn(PrestamoTableMap::COL_ESTADO);
            $criteria->addSelectColumn(PrestamoTableMap::COL_SANCION);
        } else {
            $criteria->addSelectColumn($alias . '.Id');
            $criteria->addSelectColumn($alias . '.UsuarioId');
            $criteria->addSelectColumn($alias . '.LibroId');
            $criteria->addSelectColumn($alias . '.VideoBeanId');
            $criteria->addSelectColumn($alias . '.TablaDibujoId');
            $criteria->addSelectColumn($alias . '.FechaReserva');
            $criteria->addSelectColumn($alias . '.FechaPrestamo');
            $criteria->addSelectColumn($alias . '.FechaDevolucion');
            $criteria->addSelectColumn($alias . '.Estado');
            $criteria->addSelectColumn($alias . '.Sancion');
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
        return Propel::getServiceContainer()->getDatabaseMap(PrestamoTableMap::DATABASE_NAME)->getTable(PrestamoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PrestamoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PrestamoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PrestamoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Prestamo or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Prestamo object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PrestamoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Prestamo) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PrestamoTableMap::DATABASE_NAME);
            $criteria->add(PrestamoTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PrestamoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PrestamoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PrestamoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Prestamo table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PrestamoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Prestamo or Criteria object.
     *
     * @param mixed               $criteria Criteria or Prestamo object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrestamoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Prestamo object
        }


        // Set the correct dbName
        $query = PrestamoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PrestamoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PrestamoTableMap::buildTableMap();
