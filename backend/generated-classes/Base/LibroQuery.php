<?php

namespace Base;

use \Libro as ChildLibro;
use \LibroQuery as ChildLibroQuery;
use \Exception;
use \PDO;
use Map\LibroTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Libro' table.
 *
 *
 *
 * @method     ChildLibroQuery orderById($order = Criteria::ASC) Order by the Id column
 * @method     ChildLibroQuery orderByIsbn($order = Criteria::ASC) Order by the Isbn column
 * @method     ChildLibroQuery orderByCategoria($order = Criteria::ASC) Order by the Categoria column
 * @method     ChildLibroQuery orderByNombre($order = Criteria::ASC) Order by the Nombre column
 * @method     ChildLibroQuery orderByEditorial($order = Criteria::ASC) Order by the Editorial column
 * @method     ChildLibroQuery orderByEdicion($order = Criteria::ASC) Order by the Edicion column
 * @method     ChildLibroQuery orderByFecha($order = Criteria::ASC) Order by the Fecha column
 * @method     ChildLibroQuery orderByLugar($order = Criteria::ASC) Order by the Lugar column
 * @method     ChildLibroQuery orderByEstado($order = Criteria::ASC) Order by the Estado column
 *
 * @method     ChildLibroQuery groupById() Group by the Id column
 * @method     ChildLibroQuery groupByIsbn() Group by the Isbn column
 * @method     ChildLibroQuery groupByCategoria() Group by the Categoria column
 * @method     ChildLibroQuery groupByNombre() Group by the Nombre column
 * @method     ChildLibroQuery groupByEditorial() Group by the Editorial column
 * @method     ChildLibroQuery groupByEdicion() Group by the Edicion column
 * @method     ChildLibroQuery groupByFecha() Group by the Fecha column
 * @method     ChildLibroQuery groupByLugar() Group by the Lugar column
 * @method     ChildLibroQuery groupByEstado() Group by the Estado column
 *
 * @method     ChildLibroQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLibroQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLibroQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLibroQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLibroQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLibroQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLibroQuery leftJoinPrestamo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prestamo relation
 * @method     ChildLibroQuery rightJoinPrestamo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prestamo relation
 * @method     ChildLibroQuery innerJoinPrestamo($relationAlias = null) Adds a INNER JOIN clause to the query using the Prestamo relation
 *
 * @method     ChildLibroQuery joinWithPrestamo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prestamo relation
 *
 * @method     ChildLibroQuery leftJoinWithPrestamo() Adds a LEFT JOIN clause and with to the query using the Prestamo relation
 * @method     ChildLibroQuery rightJoinWithPrestamo() Adds a RIGHT JOIN clause and with to the query using the Prestamo relation
 * @method     ChildLibroQuery innerJoinWithPrestamo() Adds a INNER JOIN clause and with to the query using the Prestamo relation
 *
 * @method     \PrestamoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLibro findOne(ConnectionInterface $con = null) Return the first ChildLibro matching the query
 * @method     ChildLibro findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLibro matching the query, or a new ChildLibro object populated from the query conditions when no match is found
 *
 * @method     ChildLibro findOneById(int $Id) Return the first ChildLibro filtered by the Id column
 * @method     ChildLibro findOneByIsbn(string $Isbn) Return the first ChildLibro filtered by the Isbn column
 * @method     ChildLibro findOneByCategoria(string $Categoria) Return the first ChildLibro filtered by the Categoria column
 * @method     ChildLibro findOneByNombre(string $Nombre) Return the first ChildLibro filtered by the Nombre column
 * @method     ChildLibro findOneByEditorial(string $Editorial) Return the first ChildLibro filtered by the Editorial column
 * @method     ChildLibro findOneByEdicion(string $Edicion) Return the first ChildLibro filtered by the Edicion column
 * @method     ChildLibro findOneByFecha(string $Fecha) Return the first ChildLibro filtered by the Fecha column
 * @method     ChildLibro findOneByLugar(string $Lugar) Return the first ChildLibro filtered by the Lugar column
 * @method     ChildLibro findOneByEstado(string $Estado) Return the first ChildLibro filtered by the Estado column *

 * @method     ChildLibro requirePk($key, ConnectionInterface $con = null) Return the ChildLibro by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLibro requireOne(ConnectionInterface $con = null) Return the first ChildLibro matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLibro requireOneById(int $Id) Return the first ChildLibro filtered by the Id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLibro requireOneByIsbn(string $Isbn) Return the first ChildLibro filtered by the Isbn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLibro requireOneByCategoria(string $Categoria) Return the first ChildLibro filtered by the Categoria column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLibro requireOneByNombre(string $Nombre) Return the first ChildLibro filtered by the Nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLibro requireOneByEditorial(string $Editorial) Return the first ChildLibro filtered by the Editorial column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLibro requireOneByEdicion(string $Edicion) Return the first ChildLibro filtered by the Edicion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLibro requireOneByFecha(string $Fecha) Return the first ChildLibro filtered by the Fecha column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLibro requireOneByLugar(string $Lugar) Return the first ChildLibro filtered by the Lugar column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLibro requireOneByEstado(string $Estado) Return the first ChildLibro filtered by the Estado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLibro[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLibro objects based on current ModelCriteria
 * @method     ChildLibro[]|ObjectCollection findById(int $Id) Return ChildLibro objects filtered by the Id column
 * @method     ChildLibro[]|ObjectCollection findByIsbn(string $Isbn) Return ChildLibro objects filtered by the Isbn column
 * @method     ChildLibro[]|ObjectCollection findByCategoria(string $Categoria) Return ChildLibro objects filtered by the Categoria column
 * @method     ChildLibro[]|ObjectCollection findByNombre(string $Nombre) Return ChildLibro objects filtered by the Nombre column
 * @method     ChildLibro[]|ObjectCollection findByEditorial(string $Editorial) Return ChildLibro objects filtered by the Editorial column
 * @method     ChildLibro[]|ObjectCollection findByEdicion(string $Edicion) Return ChildLibro objects filtered by the Edicion column
 * @method     ChildLibro[]|ObjectCollection findByFecha(string $Fecha) Return ChildLibro objects filtered by the Fecha column
 * @method     ChildLibro[]|ObjectCollection findByLugar(string $Lugar) Return ChildLibro objects filtered by the Lugar column
 * @method     ChildLibro[]|ObjectCollection findByEstado(string $Estado) Return ChildLibro objects filtered by the Estado column
 * @method     ChildLibro[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LibroQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\LibroQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Libro', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLibroQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLibroQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLibroQuery) {
            return $criteria;
        }
        $query = new ChildLibroQuery();
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
     * @return ChildLibro|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LibroTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LibroTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLibro A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT Id, Isbn, Categoria, Nombre, Editorial, Edicion, Fecha, Lugar, Estado FROM Libro WHERE Id = :p0';
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
            /** @var ChildLibro $obj */
            $obj = new ChildLibro();
            $obj->hydrate($row);
            LibroTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLibro|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LibroTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LibroTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LibroTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LibroTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the Isbn column
     *
     * Example usage:
     * <code>
     * $query->filterByIsbn('fooValue');   // WHERE Isbn = 'fooValue'
     * $query->filterByIsbn('%fooValue%', Criteria::LIKE); // WHERE Isbn LIKE '%fooValue%'
     * </code>
     *
     * @param     string $isbn The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function filterByIsbn($isbn = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isbn)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroTableMap::COL_ISBN, $isbn, $comparison);
    }

    /**
     * Filter the query on the Categoria column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoria('fooValue');   // WHERE Categoria = 'fooValue'
     * $query->filterByCategoria('%fooValue%', Criteria::LIKE); // WHERE Categoria LIKE '%fooValue%'
     * </code>
     *
     * @param     string $categoria The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function filterByCategoria($categoria = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categoria)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroTableMap::COL_CATEGORIA, $categoria, $comparison);
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
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the Editorial column
     *
     * Example usage:
     * <code>
     * $query->filterByEditorial('fooValue');   // WHERE Editorial = 'fooValue'
     * $query->filterByEditorial('%fooValue%', Criteria::LIKE); // WHERE Editorial LIKE '%fooValue%'
     * </code>
     *
     * @param     string $editorial The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function filterByEditorial($editorial = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($editorial)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroTableMap::COL_EDITORIAL, $editorial, $comparison);
    }

    /**
     * Filter the query on the Edicion column
     *
     * Example usage:
     * <code>
     * $query->filterByEdicion('fooValue');   // WHERE Edicion = 'fooValue'
     * $query->filterByEdicion('%fooValue%', Criteria::LIKE); // WHERE Edicion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $edicion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function filterByEdicion($edicion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($edicion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroTableMap::COL_EDICION, $edicion, $comparison);
    }

    /**
     * Filter the query on the Fecha column
     *
     * Example usage:
     * <code>
     * $query->filterByFecha('2011-03-14'); // WHERE Fecha = '2011-03-14'
     * $query->filterByFecha('now'); // WHERE Fecha = '2011-03-14'
     * $query->filterByFecha(array('max' => 'yesterday')); // WHERE Fecha > '2011-03-13'
     * </code>
     *
     * @param     mixed $fecha The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function filterByFecha($fecha = null, $comparison = null)
    {
        if (is_array($fecha)) {
            $useMinMax = false;
            if (isset($fecha['min'])) {
                $this->addUsingAlias(LibroTableMap::COL_FECHA, $fecha['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fecha['max'])) {
                $this->addUsingAlias(LibroTableMap::COL_FECHA, $fecha['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroTableMap::COL_FECHA, $fecha, $comparison);
    }

    /**
     * Filter the query on the Lugar column
     *
     * Example usage:
     * <code>
     * $query->filterByLugar('fooValue');   // WHERE Lugar = 'fooValue'
     * $query->filterByLugar('%fooValue%', Criteria::LIKE); // WHERE Lugar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lugar The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function filterByLugar($lugar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lugar)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroTableMap::COL_LUGAR, $lugar, $comparison);
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
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function filterByEstado($estado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroTableMap::COL_ESTADO, $estado, $comparison);
    }

    /**
     * Filter the query by a related \Prestamo object
     *
     * @param \Prestamo|ObjectCollection $prestamo the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLibroQuery The current query, for fluid interface
     */
    public function filterByPrestamo($prestamo, $comparison = null)
    {
        if ($prestamo instanceof \Prestamo) {
            return $this
                ->addUsingAlias(LibroTableMap::COL_ID, $prestamo->getLibroId(), $comparison);
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
     * @return $this|ChildLibroQuery The current query, for fluid interface
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
     * @param   ChildLibro $libro Object to remove from the list of results
     *
     * @return $this|ChildLibroQuery The current query, for fluid interface
     */
    public function prune($libro = null)
    {
        if ($libro) {
            $this->addUsingAlias(LibroTableMap::COL_ID, $libro->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Libro table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LibroTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LibroTableMap::clearInstancePool();
            LibroTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LibroTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LibroTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LibroTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LibroTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LibroQuery
