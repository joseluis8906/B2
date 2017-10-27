<?php

namespace Base;

use \Grupo as ChildGrupo;
use \GrupoQuery as ChildGrupoQuery;
use \Exception;
use \PDO;
use Map\GrupoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Grupo' table.
 *
 *
 *
 * @method     ChildGrupoQuery orderById($order = Criteria::ASC) Order by the Id column
 * @method     ChildGrupoQuery orderByNombre($order = Criteria::ASC) Order by the Nombre column
 *
 * @method     ChildGrupoQuery groupById() Group by the Id column
 * @method     ChildGrupoQuery groupByNombre() Group by the Nombre column
 *
 * @method     ChildGrupoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGrupoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGrupoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGrupoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGrupoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGrupoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGrupoQuery leftJoinUsuariogrupo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuariogrupo relation
 * @method     ChildGrupoQuery rightJoinUsuariogrupo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuariogrupo relation
 * @method     ChildGrupoQuery innerJoinUsuariogrupo($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuariogrupo relation
 *
 * @method     ChildGrupoQuery joinWithUsuariogrupo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuariogrupo relation
 *
 * @method     ChildGrupoQuery leftJoinWithUsuariogrupo() Adds a LEFT JOIN clause and with to the query using the Usuariogrupo relation
 * @method     ChildGrupoQuery rightJoinWithUsuariogrupo() Adds a RIGHT JOIN clause and with to the query using the Usuariogrupo relation
 * @method     ChildGrupoQuery innerJoinWithUsuariogrupo() Adds a INNER JOIN clause and with to the query using the Usuariogrupo relation
 *
 * @method     \UsuariogrupoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGrupo findOne(ConnectionInterface $con = null) Return the first ChildGrupo matching the query
 * @method     ChildGrupo findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGrupo matching the query, or a new ChildGrupo object populated from the query conditions when no match is found
 *
 * @method     ChildGrupo findOneById(int $Id) Return the first ChildGrupo filtered by the Id column
 * @method     ChildGrupo findOneByNombre(string $Nombre) Return the first ChildGrupo filtered by the Nombre column *

 * @method     ChildGrupo requirePk($key, ConnectionInterface $con = null) Return the ChildGrupo by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupo requireOne(ConnectionInterface $con = null) Return the first ChildGrupo matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGrupo requireOneById(int $Id) Return the first ChildGrupo filtered by the Id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupo requireOneByNombre(string $Nombre) Return the first ChildGrupo filtered by the Nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGrupo[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGrupo objects based on current ModelCriteria
 * @method     ChildGrupo[]|ObjectCollection findById(int $Id) Return ChildGrupo objects filtered by the Id column
 * @method     ChildGrupo[]|ObjectCollection findByNombre(string $Nombre) Return ChildGrupo objects filtered by the Nombre column
 * @method     ChildGrupo[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GrupoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GrupoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Grupo', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGrupoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGrupoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGrupoQuery) {
            return $criteria;
        }
        $query = new ChildGrupoQuery();
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
     * @return ChildGrupo|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GrupoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GrupoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGrupo A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT Id, Nombre FROM Grupo WHERE Id = :p0';
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
            /** @var ChildGrupo $obj */
            $obj = new ChildGrupo();
            $obj->hydrate($row);
            GrupoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGrupo|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GrupoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GrupoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GrupoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GrupoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query by a related \Usuariogrupo object
     *
     * @param \Usuariogrupo|ObjectCollection $usuariogrupo the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByUsuariogrupo($usuariogrupo, $comparison = null)
    {
        if ($usuariogrupo instanceof \Usuariogrupo) {
            return $this
                ->addUsingAlias(GrupoTableMap::COL_ID, $usuariogrupo->getGrupoid(), $comparison);
        } elseif ($usuariogrupo instanceof ObjectCollection) {
            return $this
                ->useUsuariogrupoQuery()
                ->filterByPrimaryKeys($usuariogrupo->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsuariogrupo() only accepts arguments of type \Usuariogrupo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuariogrupo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function joinUsuariogrupo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuariogrupo');

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
            $this->addJoinObject($join, 'Usuariogrupo');
        }

        return $this;
    }

    /**
     * Use the Usuariogrupo relation Usuariogrupo object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsuariogrupoQuery A secondary query class using the current class as primary query
     */
    public function useUsuariogrupoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuariogrupo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuariogrupo', '\UsuariogrupoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGrupo $grupo Object to remove from the list of results
     *
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function prune($grupo = null)
    {
        if ($grupo) {
            $this->addUsingAlias(GrupoTableMap::COL_ID, $grupo->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Grupo table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GrupoTableMap::clearInstancePool();
            GrupoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GrupoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GrupoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GrupoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GrupoQuery
