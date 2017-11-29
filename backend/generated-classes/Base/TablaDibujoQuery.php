<?php

namespace Base;

use \TablaDibujo as ChildTablaDibujo;
use \TablaDibujoQuery as ChildTablaDibujoQuery;
use \Exception;
use \PDO;
use Map\TablaDibujoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'TablaDibujo' table.
 *
 *
 *
 * @method     ChildTablaDibujoQuery orderById($order = Criteria::ASC) Order by the Id column
 * @method     ChildTablaDibujoQuery orderByCodigo($order = Criteria::ASC) Order by the Codigo column
 * @method     ChildTablaDibujoQuery orderByMarca($order = Criteria::ASC) Order by the Marca column
 * @method     ChildTablaDibujoQuery orderByEspecificaciones($order = Criteria::ASC) Order by the Especificaciones column
 * @method     ChildTablaDibujoQuery orderByEstado($order = Criteria::ASC) Order by the Estado column
 *
 * @method     ChildTablaDibujoQuery groupById() Group by the Id column
 * @method     ChildTablaDibujoQuery groupByCodigo() Group by the Codigo column
 * @method     ChildTablaDibujoQuery groupByMarca() Group by the Marca column
 * @method     ChildTablaDibujoQuery groupByEspecificaciones() Group by the Especificaciones column
 * @method     ChildTablaDibujoQuery groupByEstado() Group by the Estado column
 *
 * @method     ChildTablaDibujoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTablaDibujoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTablaDibujoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTablaDibujoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTablaDibujoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTablaDibujoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTablaDibujoQuery leftJoinPrestamo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prestamo relation
 * @method     ChildTablaDibujoQuery rightJoinPrestamo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prestamo relation
 * @method     ChildTablaDibujoQuery innerJoinPrestamo($relationAlias = null) Adds a INNER JOIN clause to the query using the Prestamo relation
 *
 * @method     ChildTablaDibujoQuery joinWithPrestamo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prestamo relation
 *
 * @method     ChildTablaDibujoQuery leftJoinWithPrestamo() Adds a LEFT JOIN clause and with to the query using the Prestamo relation
 * @method     ChildTablaDibujoQuery rightJoinWithPrestamo() Adds a RIGHT JOIN clause and with to the query using the Prestamo relation
 * @method     ChildTablaDibujoQuery innerJoinWithPrestamo() Adds a INNER JOIN clause and with to the query using the Prestamo relation
 *
 * @method     \PrestamoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTablaDibujo findOne(ConnectionInterface $con = null) Return the first ChildTablaDibujo matching the query
 * @method     ChildTablaDibujo findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTablaDibujo matching the query, or a new ChildTablaDibujo object populated from the query conditions when no match is found
 *
 * @method     ChildTablaDibujo findOneById(int $Id) Return the first ChildTablaDibujo filtered by the Id column
 * @method     ChildTablaDibujo findOneByCodigo(string $Codigo) Return the first ChildTablaDibujo filtered by the Codigo column
 * @method     ChildTablaDibujo findOneByMarca(string $Marca) Return the first ChildTablaDibujo filtered by the Marca column
 * @method     ChildTablaDibujo findOneByEspecificaciones(string $Especificaciones) Return the first ChildTablaDibujo filtered by the Especificaciones column
 * @method     ChildTablaDibujo findOneByEstado(string $Estado) Return the first ChildTablaDibujo filtered by the Estado column *

 * @method     ChildTablaDibujo requirePk($key, ConnectionInterface $con = null) Return the ChildTablaDibujo by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTablaDibujo requireOne(ConnectionInterface $con = null) Return the first ChildTablaDibujo matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTablaDibujo requireOneById(int $Id) Return the first ChildTablaDibujo filtered by the Id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTablaDibujo requireOneByCodigo(string $Codigo) Return the first ChildTablaDibujo filtered by the Codigo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTablaDibujo requireOneByMarca(string $Marca) Return the first ChildTablaDibujo filtered by the Marca column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTablaDibujo requireOneByEspecificaciones(string $Especificaciones) Return the first ChildTablaDibujo filtered by the Especificaciones column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTablaDibujo requireOneByEstado(string $Estado) Return the first ChildTablaDibujo filtered by the Estado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTablaDibujo[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTablaDibujo objects based on current ModelCriteria
 * @method     ChildTablaDibujo[]|ObjectCollection findById(int $Id) Return ChildTablaDibujo objects filtered by the Id column
 * @method     ChildTablaDibujo[]|ObjectCollection findByCodigo(string $Codigo) Return ChildTablaDibujo objects filtered by the Codigo column
 * @method     ChildTablaDibujo[]|ObjectCollection findByMarca(string $Marca) Return ChildTablaDibujo objects filtered by the Marca column
 * @method     ChildTablaDibujo[]|ObjectCollection findByEspecificaciones(string $Especificaciones) Return ChildTablaDibujo objects filtered by the Especificaciones column
 * @method     ChildTablaDibujo[]|ObjectCollection findByEstado(string $Estado) Return ChildTablaDibujo objects filtered by the Estado column
 * @method     ChildTablaDibujo[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TablaDibujoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TablaDibujoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TablaDibujo', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTablaDibujoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTablaDibujoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTablaDibujoQuery) {
            return $criteria;
        }
        $query = new ChildTablaDibujoQuery();
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
     * @return ChildTablaDibujo|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TablaDibujoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TablaDibujoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTablaDibujo A model object, or null if the key is not found
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
            /** @var ChildTablaDibujo $obj */
            $obj = new ChildTablaDibujo();
            $obj->hydrate($row);
            TablaDibujoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTablaDibujo|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTablaDibujoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TablaDibujoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTablaDibujoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TablaDibujoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildTablaDibujoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TablaDibujoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TablaDibujoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TablaDibujoTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildTablaDibujoQuery The current query, for fluid interface
     */
    public function filterByCodigo($codigo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TablaDibujoTableMap::COL_CODIGO, $codigo, $comparison);
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
     * @return $this|ChildTablaDibujoQuery The current query, for fluid interface
     */
    public function filterByMarca($marca = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($marca)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TablaDibujoTableMap::COL_MARCA, $marca, $comparison);
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
     * @return $this|ChildTablaDibujoQuery The current query, for fluid interface
     */
    public function filterByEspecificaciones($especificaciones = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($especificaciones)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TablaDibujoTableMap::COL_ESPECIFICACIONES, $especificaciones, $comparison);
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
     * @return $this|ChildTablaDibujoQuery The current query, for fluid interface
     */
    public function filterByEstado($estado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TablaDibujoTableMap::COL_ESTADO, $estado, $comparison);
    }

    /**
     * Filter the query by a related \Prestamo object
     *
     * @param \Prestamo|ObjectCollection $prestamo the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTablaDibujoQuery The current query, for fluid interface
     */
    public function filterByPrestamo($prestamo, $comparison = null)
    {
        if ($prestamo instanceof \Prestamo) {
            return $this
                ->addUsingAlias(TablaDibujoTableMap::COL_ID, $prestamo->getTablaDibujoId(), $comparison);
        } elseif ($prestamo instanceof ObjectCollection) {
            return $this
                ->usePrestamoQuery()
                ->filterByPrimaryKeys($prestamo->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPrestamo() only accepts arguments of type \Prestamo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Prestamo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTablaDibujoQuery The current query, for fluid interface
     */
    public function joinPrestamo($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Prestamo');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Prestamo');
        }

        return $this;
    }

    /**
     * Use the Prestamo relation Prestamo object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PrestamoQuery A secondary query class using the current class as primary query
     */
    public function usePrestamoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPrestamo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Prestamo', '\PrestamoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTablaDibujo $tablaDibujo Object to remove from the list of results
     *
     * @return $this|ChildTablaDibujoQuery The current query, for fluid interface
     */
    public function prune($tablaDibujo = null)
    {
        if ($tablaDibujo) {
            $this->addUsingAlias(TablaDibujoTableMap::COL_ID, $tablaDibujo->getId(), Criteria::NOT_EQUAL);
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
            $con = Propel::getServiceContainer()->getWriteConnection(TablaDibujoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TablaDibujoTableMap::clearInstancePool();
            TablaDibujoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TablaDibujoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TablaDibujoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TablaDibujoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TablaDibujoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TablaDibujoQuery
