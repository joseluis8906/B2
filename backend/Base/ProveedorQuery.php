<?php

namespace Base;

use \Proveedor as ChildProveedor;
use \ProveedorQuery as ChildProveedorQuery;
use \Exception;
use \PDO;
use Map\ProveedorTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Proveedor' table.
 *
 *
 *
 * @method     ChildProveedorQuery orderById($order = Criteria::ASC) Order by the Id column
 * @method     ChildProveedorQuery orderByCodigo($order = Criteria::ASC) Order by the Codigo column
 * @method     ChildProveedorQuery orderByNombre($order = Criteria::ASC) Order by the Nombre column
 * @method     ChildProveedorQuery orderByOrigen($order = Criteria::ASC) Order by the Origen column
 *
 * @method     ChildProveedorQuery groupById() Group by the Id column
 * @method     ChildProveedorQuery groupByCodigo() Group by the Codigo column
 * @method     ChildProveedorQuery groupByNombre() Group by the Nombre column
 * @method     ChildProveedorQuery groupByOrigen() Group by the Origen column
 *
 * @method     ChildProveedorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProveedorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProveedorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProveedorQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProveedorQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProveedorQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProveedor findOne(ConnectionInterface $con = null) Return the first ChildProveedor matching the query
 * @method     ChildProveedor findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProveedor matching the query, or a new ChildProveedor object populated from the query conditions when no match is found
 *
 * @method     ChildProveedor findOneById(int $Id) Return the first ChildProveedor filtered by the Id column
 * @method     ChildProveedor findOneByCodigo(string $Codigo) Return the first ChildProveedor filtered by the Codigo column
 * @method     ChildProveedor findOneByNombre(string $Nombre) Return the first ChildProveedor filtered by the Nombre column
 * @method     ChildProveedor findOneByOrigen(string $Origen) Return the first ChildProveedor filtered by the Origen column *

 * @method     ChildProveedor requirePk($key, ConnectionInterface $con = null) Return the ChildProveedor by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProveedor requireOne(ConnectionInterface $con = null) Return the first ChildProveedor matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProveedor requireOneById(int $Id) Return the first ChildProveedor filtered by the Id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProveedor requireOneByCodigo(string $Codigo) Return the first ChildProveedor filtered by the Codigo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProveedor requireOneByNombre(string $Nombre) Return the first ChildProveedor filtered by the Nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProveedor requireOneByOrigen(string $Origen) Return the first ChildProveedor filtered by the Origen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProveedor[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProveedor objects based on current ModelCriteria
 * @method     ChildProveedor[]|ObjectCollection findById(int $Id) Return ChildProveedor objects filtered by the Id column
 * @method     ChildProveedor[]|ObjectCollection findByCodigo(string $Codigo) Return ChildProveedor objects filtered by the Codigo column
 * @method     ChildProveedor[]|ObjectCollection findByNombre(string $Nombre) Return ChildProveedor objects filtered by the Nombre column
 * @method     ChildProveedor[]|ObjectCollection findByOrigen(string $Origen) Return ChildProveedor objects filtered by the Origen column
 * @method     ChildProveedor[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProveedorQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProveedorQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Proveedor', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProveedorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProveedorQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProveedorQuery) {
            return $criteria;
        }
        $query = new ChildProveedorQuery();
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
     * @return ChildProveedor|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProveedorTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProveedorTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProveedor A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT Id, Codigo, Nombre, Origen FROM Proveedor WHERE Id = :p0';
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
            /** @var ChildProveedor $obj */
            $obj = new ChildProveedor();
            $obj->hydrate($row);
            ProveedorTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProveedor|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProveedorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProveedorTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProveedorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProveedorTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProveedorQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProveedorTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProveedorTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProveedorTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildProveedorQuery The current query, for fluid interface
     */
    public function filterByCodigo($codigo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProveedorTableMap::COL_CODIGO, $codigo, $comparison);
    }

    /**
     * Filter the query on the Nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE Nombre = 'fooValue'
     * $query->filterByNombre('%fooValue%', Criteria::LIKE); // WHERE Nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProveedorQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProveedorTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the Origen column
     *
     * Example usage:
     * <code>
     * $query->filterByOrigen('fooValue');   // WHERE Origen = 'fooValue'
     * $query->filterByOrigen('%fooValue%', Criteria::LIKE); // WHERE Origen LIKE '%fooValue%'
     * </code>
     *
     * @param     string $origen The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProveedorQuery The current query, for fluid interface
     */
    public function filterByOrigen($origen = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($origen)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProveedorTableMap::COL_ORIGEN, $origen, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProveedor $proveedor Object to remove from the list of results
     *
     * @return $this|ChildProveedorQuery The current query, for fluid interface
     */
    public function prune($proveedor = null)
    {
        if ($proveedor) {
            $this->addUsingAlias(ProveedorTableMap::COL_ID, $proveedor->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Proveedor table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProveedorTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProveedorTableMap::clearInstancePool();
            ProveedorTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProveedorTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProveedorTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProveedorTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProveedorTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProveedorQuery
