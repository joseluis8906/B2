<?php

namespace Base;

use \Videobean as ChildVideobean;
use \VideobeanQuery as ChildVideobeanQuery;
use \Exception;
use \PDO;
use Map\VideobeanTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'VideoBean' table.
 *
 *
 *
 * @method     ChildVideobeanQuery orderById($order = Criteria::ASC) Order by the Id column
 * @method     ChildVideobeanQuery orderByCodigo($order = Criteria::ASC) Order by the Codigo column
 * @method     ChildVideobeanQuery orderByMarca($order = Criteria::ASC) Order by the Marca column
 * @method     ChildVideobeanQuery orderByModelo($order = Criteria::ASC) Order by the Modelo column
 * @method     ChildVideobeanQuery orderByEspecificaciones($order = Criteria::ASC) Order by the Especificaciones column
 * @method     ChildVideobeanQuery orderByAccesorios($order = Criteria::ASC) Order by the Accesorios column
 * @method     ChildVideobeanQuery orderByEstado($order = Criteria::ASC) Order by the Estado column
 *
 * @method     ChildVideobeanQuery groupById() Group by the Id column
 * @method     ChildVideobeanQuery groupByCodigo() Group by the Codigo column
 * @method     ChildVideobeanQuery groupByMarca() Group by the Marca column
 * @method     ChildVideobeanQuery groupByModelo() Group by the Modelo column
 * @method     ChildVideobeanQuery groupByEspecificaciones() Group by the Especificaciones column
 * @method     ChildVideobeanQuery groupByAccesorios() Group by the Accesorios column
 * @method     ChildVideobeanQuery groupByEstado() Group by the Estado column
 *
 * @method     ChildVideobeanQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVideobeanQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVideobeanQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVideobeanQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVideobeanQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVideobeanQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVideobean findOne(ConnectionInterface $con = null) Return the first ChildVideobean matching the query
 * @method     ChildVideobean findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVideobean matching the query, or a new ChildVideobean object populated from the query conditions when no match is found
 *
 * @method     ChildVideobean findOneById(int $Id) Return the first ChildVideobean filtered by the Id column
 * @method     ChildVideobean findOneByCodigo(string $Codigo) Return the first ChildVideobean filtered by the Codigo column
 * @method     ChildVideobean findOneByMarca(string $Marca) Return the first ChildVideobean filtered by the Marca column
 * @method     ChildVideobean findOneByModelo(string $Modelo) Return the first ChildVideobean filtered by the Modelo column
 * @method     ChildVideobean findOneByEspecificaciones(string $Especificaciones) Return the first ChildVideobean filtered by the Especificaciones column
 * @method     ChildVideobean findOneByAccesorios(string $Accesorios) Return the first ChildVideobean filtered by the Accesorios column
 * @method     ChildVideobean findOneByEstado(string $Estado) Return the first ChildVideobean filtered by the Estado column *

 * @method     ChildVideobean requirePk($key, ConnectionInterface $con = null) Return the ChildVideobean by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideobean requireOne(ConnectionInterface $con = null) Return the first ChildVideobean matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVideobean requireOneById(int $Id) Return the first ChildVideobean filtered by the Id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideobean requireOneByCodigo(string $Codigo) Return the first ChildVideobean filtered by the Codigo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideobean requireOneByMarca(string $Marca) Return the first ChildVideobean filtered by the Marca column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideobean requireOneByModelo(string $Modelo) Return the first ChildVideobean filtered by the Modelo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideobean requireOneByEspecificaciones(string $Especificaciones) Return the first ChildVideobean filtered by the Especificaciones column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideobean requireOneByAccesorios(string $Accesorios) Return the first ChildVideobean filtered by the Accesorios column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideobean requireOneByEstado(string $Estado) Return the first ChildVideobean filtered by the Estado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVideobean[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVideobean objects based on current ModelCriteria
 * @method     ChildVideobean[]|ObjectCollection findById(int $Id) Return ChildVideobean objects filtered by the Id column
 * @method     ChildVideobean[]|ObjectCollection findByCodigo(string $Codigo) Return ChildVideobean objects filtered by the Codigo column
 * @method     ChildVideobean[]|ObjectCollection findByMarca(string $Marca) Return ChildVideobean objects filtered by the Marca column
 * @method     ChildVideobean[]|ObjectCollection findByModelo(string $Modelo) Return ChildVideobean objects filtered by the Modelo column
 * @method     ChildVideobean[]|ObjectCollection findByEspecificaciones(string $Especificaciones) Return ChildVideobean objects filtered by the Especificaciones column
 * @method     ChildVideobean[]|ObjectCollection findByAccesorios(string $Accesorios) Return ChildVideobean objects filtered by the Accesorios column
 * @method     ChildVideobean[]|ObjectCollection findByEstado(string $Estado) Return ChildVideobean objects filtered by the Estado column
 * @method     ChildVideobean[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VideobeanQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\VideobeanQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Videobean', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVideobeanQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVideobeanQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVideobeanQuery) {
            return $criteria;
        }
        $query = new ChildVideobeanQuery();
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
     * @return ChildVideobean|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VideobeanTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VideobeanTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVideobean A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT Id, Codigo, Marca, Modelo, Especificaciones, Accesorios, Estado FROM VideoBean WHERE Id = :p0';
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
            /** @var ChildVideobean $obj */
            $obj = new ChildVideobean();
            $obj->hydrate($row);
            VideobeanTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVideobean|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVideobeanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VideobeanTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVideobeanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VideobeanTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildVideobeanQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VideobeanTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VideobeanTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideobeanTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildVideobeanQuery The current query, for fluid interface
     */
    public function filterByCodigo($codigo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideobeanTableMap::COL_CODIGO, $codigo, $comparison);
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
     * @return $this|ChildVideobeanQuery The current query, for fluid interface
     */
    public function filterByMarca($marca = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($marca)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideobeanTableMap::COL_MARCA, $marca, $comparison);
    }

    /**
     * Filter the query on the Modelo column
     *
     * Example usage:
     * <code>
     * $query->filterByModelo('fooValue');   // WHERE Modelo = 'fooValue'
     * $query->filterByModelo('%fooValue%', Criteria::LIKE); // WHERE Modelo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $modelo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideobeanQuery The current query, for fluid interface
     */
    public function filterByModelo($modelo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($modelo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideobeanTableMap::COL_MODELO, $modelo, $comparison);
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
     * @return $this|ChildVideobeanQuery The current query, for fluid interface
     */
    public function filterByEspecificaciones($especificaciones = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($especificaciones)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideobeanTableMap::COL_ESPECIFICACIONES, $especificaciones, $comparison);
    }

    /**
     * Filter the query on the Accesorios column
     *
     * Example usage:
     * <code>
     * $query->filterByAccesorios('fooValue');   // WHERE Accesorios = 'fooValue'
     * $query->filterByAccesorios('%fooValue%', Criteria::LIKE); // WHERE Accesorios LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accesorios The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideobeanQuery The current query, for fluid interface
     */
    public function filterByAccesorios($accesorios = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accesorios)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideobeanTableMap::COL_ACCESORIOS, $accesorios, $comparison);
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
     * @return $this|ChildVideobeanQuery The current query, for fluid interface
     */
    public function filterByEstado($estado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideobeanTableMap::COL_ESTADO, $estado, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVideobean $videobean Object to remove from the list of results
     *
     * @return $this|ChildVideobeanQuery The current query, for fluid interface
     */
    public function prune($videobean = null)
    {
        if ($videobean) {
            $this->addUsingAlias(VideobeanTableMap::COL_ID, $videobean->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the VideoBean table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideobeanTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VideobeanTableMap::clearInstancePool();
            VideobeanTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VideobeanTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VideobeanTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VideobeanTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VideobeanTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VideobeanQuery
