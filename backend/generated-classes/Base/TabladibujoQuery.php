<?php

namespace Base;

use \Tabladibujo as ChildTabladibujo;
use \TabladibujoQuery as ChildTabladibujoQuery;
use \Exception;
use \PDO;
use Map\TabladibujoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'TablaDibujo' table.
 *
 *
 *
 * @method     ChildTabladibujoQuery orderById($order = Criteria::ASC) Order by the Id column
 * @method     ChildTabladibujoQuery orderByCodigo($order = Criteria::ASC) Order by the Codigo column
 * @method     ChildTabladibujoQuery orderByMarca($order = Criteria::ASC) Order by the Marca column
 * @method     ChildTabladibujoQuery orderByEspecificaciones($order = Criteria::ASC) Order by the Especificaciones column
 * @method     ChildTabladibujoQuery orderByEstado($order = Criteria::ASC) Order by the Estado column
 *
 * @method     ChildTabladibujoQuery groupById() Group by the Id column
 * @method     ChildTabladibujoQuery groupByCodigo() Group by the Codigo column
 * @method     ChildTabladibujoQuery groupByMarca() Group by the Marca column
 * @method     ChildTabladibujoQuery groupByEspecificaciones() Group by the Especificaciones column
 * @method     ChildTabladibujoQuery groupByEstado() Group by the Estado column
 *
 * @method     ChildTabladibujoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTabladibujoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTabladibujoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTabladibujoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTabladibujoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTabladibujoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTabladibujo findOne(ConnectionInterface $con = null) Return the first ChildTabladibujo matching the query
 * @method     ChildTabladibujo findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTabladibujo matching the query, or a new ChildTabladibujo object populated from the query conditions when no match is found
 *
 * @method     ChildTabladibujo findOneById(int $Id) Return the first ChildTabladibujo filtered by the Id column
 * @method     ChildTabladibujo findOneByCodigo(string $Codigo) Return the first ChildTabladibujo filtered by the Codigo column
 * @method     ChildTabladibujo findOneByMarca(string $Marca) Return the first ChildTabladibujo filtered by the Marca column
 * @method     ChildTabladibujo findOneByEspecificaciones(string $Especificaciones) Return the first ChildTabladibujo filtered by the Especificaciones column
 * @method     ChildTabladibujo findOneByEstado(string $Estado) Return the first ChildTabladibujo filtered by the Estado column *

 * @method     ChildTabladibujo requirePk($key, ConnectionInterface $con = null) Return the ChildTabladibujo by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabladibujo requireOne(ConnectionInterface $con = null) Return the first ChildTabladibujo matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTabladibujo requireOneById(int $Id) Return the first ChildTabladibujo filtered by the Id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabladibujo requireOneByCodigo(string $Codigo) Return the first ChildTabladibujo filtered by the Codigo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabladibujo requireOneByMarca(string $Marca) Return the first ChildTabladibujo filtered by the Marca column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabladibujo requireOneByEspecificaciones(string $Especificaciones) Return the first ChildTabladibujo filtered by the Especificaciones column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabladibujo requireOneByEstado(string $Estado) Return the first ChildTabladibujo filtered by the Estado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTabladibujo[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTabladibujo objects based on current ModelCriteria
 * @method     ChildTabladibujo[]|ObjectCollection findById(int $Id) Return ChildTabladibujo objects filtered by the Id column
 * @method     ChildTabladibujo[]|ObjectCollection findByCodigo(string $Codigo) Return ChildTabladibujo objects filtered by the Codigo column
 * @method     ChildTabladibujo[]|ObjectCollection findByMarca(string $Marca) Return ChildTabladibujo objects filtered by the Marca column
 * @method     ChildTabladibujo[]|ObjectCollection findByEspecificaciones(string $Especificaciones) Return ChildTabladibujo objects filtered by the Especificaciones column
 * @method     ChildTabladibujo[]|ObjectCollection findByEstado(string $Estado) Return ChildTabladibujo objects filtered by the Estado column
 * @method     ChildTabladibujo[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TabladibujoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TabladibujoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tabladibujo', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTabladibujoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTabladibujoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTabladibujoQuery) {
            return $criteria;
        }
        $query = new ChildTabladibujoQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTabladibujo|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TabladibujoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TabladibujoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTabladibujo A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT Id, Codigo, Marca, Especificaciones, Estado FROM TablaDibujo WHERE Id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTabladibujo $obj */
            $obj = new ChildTabladibujo();
            $obj->hydrate($row);
            TabladibujoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildTabladibujo|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildTabladibujoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TabladibujoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTabladibujoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TabladibujoTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the Id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE Id = 1234
     * $query->filterById(array(12, 34)); // WHERE Id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE Id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTabladibujoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TabladibujoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TabladibujoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TabladibujoTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the Codigo column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigo('fooValue');   // WHERE Codigo = 'fooValue'
     * $query->filterByCodigo('%fooValue%', Criteria::LIKE); // WHERE Codigo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codigo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTabladibujoQuery The current query, for fluid interface
     */
    public function filterByCodigo($codigo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TabladibujoTableMap::COL_CODIGO, $codigo, $comparison);
    }

    /**
     * Filter the query on the Marca column
     *
     * Example usage:
     * <code>
     * $query->filterByMarca('fooValue');   // WHERE Marca = 'fooValue'
     * $query->filterByMarca('%fooValue%', Criteria::LIKE); // WHERE Marca LIKE '%fooValue%'
     * </code>
     *
     * @param     string $marca The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTabladibujoQuery The current query, for fluid interface
     */
    public function filterByMarca($marca = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($marca)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TabladibujoTableMap::COL_MARCA, $marca, $comparison);
    }

    /**
     * Filter the query on the Especificaciones column
     *
     * Example usage:
     * <code>
     * $query->filterByEspecificaciones('fooValue');   // WHERE Especificaciones = 'fooValue'
     * $query->filterByEspecificaciones('%fooValue%', Criteria::LIKE); // WHERE Especificaciones LIKE '%fooValue%'
     * </code>
     *
     * @param     string $especificaciones The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTabladibujoQuery The current query, for fluid interface
     */
    public function filterByEspecificaciones($especificaciones = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($especificaciones)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TabladibujoTableMap::COL_ESPECIFICACIONES, $especificaciones, $comparison);
    }

    /**
     * Filter the query on the Estado column
     *
     * Example usage:
     * <code>
     * $query->filterByEstado('fooValue');   // WHERE Estado = 'fooValue'
     * $query->filterByEstado('%fooValue%', Criteria::LIKE); // WHERE Estado LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estado The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTabladibujoQuery The current query, for fluid interface
     */
    public function filterByEstado($estado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TabladibujoTableMap::COL_ESTADO, $estado, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTabladibujo $tabladibujo Object to remove from the list of results
     *
     * @return $this|ChildTabladibujoQuery The current query, for fluid interface
     */
    public function prune($tabladibujo = null)
    {
        if ($tabladibujo) {
            $this->addUsingAlias(TabladibujoTableMap::COL_ID, $tabladibujo->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the TablaDibujo table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TabladibujoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TabladibujoTableMap::clearInstancePool();
            TabladibujoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TabladibujoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TabladibujoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TabladibujoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TabladibujoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TabladibujoQuery
