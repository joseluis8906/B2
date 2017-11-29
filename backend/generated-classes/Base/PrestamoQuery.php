<?php

namespace Base;

use \Prestamo as ChildPrestamo;
use \PrestamoQuery as ChildPrestamoQuery;
use \Exception;
use \PDO;
use Map\PrestamoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Prestamo' table.
 *
 *
 *
 * @method     ChildPrestamoQuery orderById($order = Criteria::ASC) Order by the Id column
 * @method     ChildPrestamoQuery orderByUsuarioId($order = Criteria::ASC) Order by the UsuarioId column
 * @method     ChildPrestamoQuery orderByLibroId($order = Criteria::ASC) Order by the LibroId column
 * @method     ChildPrestamoQuery orderByVideoBeanId($order = Criteria::ASC) Order by the VideoBeanId column
 * @method     ChildPrestamoQuery orderByTablaDibujoId($order = Criteria::ASC) Order by the TablaDibujoId column
 * @method     ChildPrestamoQuery orderByFechaReserva($order = Criteria::ASC) Order by the FechaReserva column
 * @method     ChildPrestamoQuery orderByFechaPrestamo($order = Criteria::ASC) Order by the FechaPrestamo column
 * @method     ChildPrestamoQuery orderByFechaDevolucion($order = Criteria::ASC) Order by the FechaDevolucion column
 * @method     ChildPrestamoQuery orderByEstado($order = Criteria::ASC) Order by the Estado column
 * @method     ChildPrestamoQuery orderBySancion($order = Criteria::ASC) Order by the Sancion column
 *
 * @method     ChildPrestamoQuery groupById() Group by the Id column
 * @method     ChildPrestamoQuery groupByUsuarioId() Group by the UsuarioId column
 * @method     ChildPrestamoQuery groupByLibroId() Group by the LibroId column
 * @method     ChildPrestamoQuery groupByVideoBeanId() Group by the VideoBeanId column
 * @method     ChildPrestamoQuery groupByTablaDibujoId() Group by the TablaDibujoId column
 * @method     ChildPrestamoQuery groupByFechaReserva() Group by the FechaReserva column
 * @method     ChildPrestamoQuery groupByFechaPrestamo() Group by the FechaPrestamo column
 * @method     ChildPrestamoQuery groupByFechaDevolucion() Group by the FechaDevolucion column
 * @method     ChildPrestamoQuery groupByEstado() Group by the Estado column
 * @method     ChildPrestamoQuery groupBySancion() Group by the Sancion column
 *
 * @method     ChildPrestamoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPrestamoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPrestamoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPrestamoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPrestamoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPrestamoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPrestamoQuery leftJoinTablaDibujo($relationAlias = null) Adds a LEFT JOIN clause to the query using the TablaDibujo relation
 * @method     ChildPrestamoQuery rightJoinTablaDibujo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TablaDibujo relation
 * @method     ChildPrestamoQuery innerJoinTablaDibujo($relationAlias = null) Adds a INNER JOIN clause to the query using the TablaDibujo relation
 *
 * @method     ChildPrestamoQuery joinWithTablaDibujo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TablaDibujo relation
 *
 * @method     ChildPrestamoQuery leftJoinWithTablaDibujo() Adds a LEFT JOIN clause and with to the query using the TablaDibujo relation
 * @method     ChildPrestamoQuery rightJoinWithTablaDibujo() Adds a RIGHT JOIN clause and with to the query using the TablaDibujo relation
 * @method     ChildPrestamoQuery innerJoinWithTablaDibujo() Adds a INNER JOIN clause and with to the query using the TablaDibujo relation
 *
 * @method     ChildPrestamoQuery leftJoinVideoBean($relationAlias = null) Adds a LEFT JOIN clause to the query using the VideoBean relation
 * @method     ChildPrestamoQuery rightJoinVideoBean($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VideoBean relation
 * @method     ChildPrestamoQuery innerJoinVideoBean($relationAlias = null) Adds a INNER JOIN clause to the query using the VideoBean relation
 *
 * @method     ChildPrestamoQuery joinWithVideoBean($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VideoBean relation
 *
 * @method     ChildPrestamoQuery leftJoinWithVideoBean() Adds a LEFT JOIN clause and with to the query using the VideoBean relation
 * @method     ChildPrestamoQuery rightJoinWithVideoBean() Adds a RIGHT JOIN clause and with to the query using the VideoBean relation
 * @method     ChildPrestamoQuery innerJoinWithVideoBean() Adds a INNER JOIN clause and with to the query using the VideoBean relation
 *
 * @method     ChildPrestamoQuery leftJoinLibro($relationAlias = null) Adds a LEFT JOIN clause to the query using the Libro relation
 * @method     ChildPrestamoQuery rightJoinLibro($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Libro relation
 * @method     ChildPrestamoQuery innerJoinLibro($relationAlias = null) Adds a INNER JOIN clause to the query using the Libro relation
 *
 * @method     ChildPrestamoQuery joinWithLibro($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Libro relation
 *
 * @method     ChildPrestamoQuery leftJoinWithLibro() Adds a LEFT JOIN clause and with to the query using the Libro relation
 * @method     ChildPrestamoQuery rightJoinWithLibro() Adds a RIGHT JOIN clause and with to the query using the Libro relation
 * @method     ChildPrestamoQuery innerJoinWithLibro() Adds a INNER JOIN clause and with to the query using the Libro relation
 *
 * @method     ChildPrestamoQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildPrestamoQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildPrestamoQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildPrestamoQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildPrestamoQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildPrestamoQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildPrestamoQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     \TablaDibujoQuery|\VideoBeanQuery|\LibroQuery|\UsuarioQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPrestamo findOne(ConnectionInterface $con = null) Return the first ChildPrestamo matching the query
 * @method     ChildPrestamo findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPrestamo matching the query, or a new ChildPrestamo object populated from the query conditions when no match is found
 *
 * @method     ChildPrestamo findOneById(int $Id) Return the first ChildPrestamo filtered by the Id column
 * @method     ChildPrestamo findOneByUsuarioId(int $UsuarioId) Return the first ChildPrestamo filtered by the UsuarioId column
 * @method     ChildPrestamo findOneByLibroId(int $LibroId) Return the first ChildPrestamo filtered by the LibroId column
 * @method     ChildPrestamo findOneByVideoBeanId(int $VideoBeanId) Return the first ChildPrestamo filtered by the VideoBeanId column
 * @method     ChildPrestamo findOneByTablaDibujoId(int $TablaDibujoId) Return the first ChildPrestamo filtered by the TablaDibujoId column
 * @method     ChildPrestamo findOneByFechaReserva(string $FechaReserva) Return the first ChildPrestamo filtered by the FechaReserva column
 * @method     ChildPrestamo findOneByFechaPrestamo(string $FechaPrestamo) Return the first ChildPrestamo filtered by the FechaPrestamo column
 * @method     ChildPrestamo findOneByFechaDevolucion(string $FechaDevolucion) Return the first ChildPrestamo filtered by the FechaDevolucion column
 * @method     ChildPrestamo findOneByEstado(string $Estado) Return the first ChildPrestamo filtered by the Estado column
 * @method     ChildPrestamo findOneBySancion(string $Sancion) Return the first ChildPrestamo filtered by the Sancion column *

 * @method     ChildPrestamo requirePk($key, ConnectionInterface $con = null) Return the ChildPrestamo by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestamo requireOne(ConnectionInterface $con = null) Return the first ChildPrestamo matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrestamo requireOneById(int $Id) Return the first ChildPrestamo filtered by the Id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestamo requireOneByUsuarioId(int $UsuarioId) Return the first ChildPrestamo filtered by the UsuarioId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestamo requireOneByLibroId(int $LibroId) Return the first ChildPrestamo filtered by the LibroId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestamo requireOneByVideoBeanId(int $VideoBeanId) Return the first ChildPrestamo filtered by the VideoBeanId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestamo requireOneByTablaDibujoId(int $TablaDibujoId) Return the first ChildPrestamo filtered by the TablaDibujoId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestamo requireOneByFechaReserva(string $FechaReserva) Return the first ChildPrestamo filtered by the FechaReserva column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestamo requireOneByFechaPrestamo(string $FechaPrestamo) Return the first ChildPrestamo filtered by the FechaPrestamo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestamo requireOneByFechaDevolucion(string $FechaDevolucion) Return the first ChildPrestamo filtered by the FechaDevolucion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestamo requireOneByEstado(string $Estado) Return the first ChildPrestamo filtered by the Estado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestamo requireOneBySancion(string $Sancion) Return the first ChildPrestamo filtered by the Sancion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrestamo[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPrestamo objects based on current ModelCriteria
 * @method     ChildPrestamo[]|ObjectCollection findById(int $Id) Return ChildPrestamo objects filtered by the Id column
 * @method     ChildPrestamo[]|ObjectCollection findByUsuarioId(int $UsuarioId) Return ChildPrestamo objects filtered by the UsuarioId column
 * @method     ChildPrestamo[]|ObjectCollection findByLibroId(int $LibroId) Return ChildPrestamo objects filtered by the LibroId column
 * @method     ChildPrestamo[]|ObjectCollection findByVideoBeanId(int $VideoBeanId) Return ChildPrestamo objects filtered by the VideoBeanId column
 * @method     ChildPrestamo[]|ObjectCollection findByTablaDibujoId(int $TablaDibujoId) Return ChildPrestamo objects filtered by the TablaDibujoId column
 * @method     ChildPrestamo[]|ObjectCollection findByFechaReserva(string $FechaReserva) Return ChildPrestamo objects filtered by the FechaReserva column
 * @method     ChildPrestamo[]|ObjectCollection findByFechaPrestamo(string $FechaPrestamo) Return ChildPrestamo objects filtered by the FechaPrestamo column
 * @method     ChildPrestamo[]|ObjectCollection findByFechaDevolucion(string $FechaDevolucion) Return ChildPrestamo objects filtered by the FechaDevolucion column
 * @method     ChildPrestamo[]|ObjectCollection findByEstado(string $Estado) Return ChildPrestamo objects filtered by the Estado column
 * @method     ChildPrestamo[]|ObjectCollection findBySancion(string $Sancion) Return ChildPrestamo objects filtered by the Sancion column
 * @method     ChildPrestamo[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PrestamoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PrestamoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Prestamo', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPrestamoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPrestamoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPrestamoQuery) {
            return $criteria;
        }
        $query = new ChildPrestamoQuery();
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
     * @return ChildPrestamo|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PrestamoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PrestamoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPrestamo A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT Id, UsuarioId, LibroId, VideoBeanId, TablaDibujoId, FechaReserva, FechaPrestamo, FechaDevolucion, Estado, Sancion FROM Prestamo WHERE Id = :p0';
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
            /** @var ChildPrestamo $obj */
            $obj = new ChildPrestamo();
            $obj->hydrate($row);
            PrestamoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPrestamo|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PrestamoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PrestamoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestamoTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the UsuarioId column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuarioId(1234); // WHERE UsuarioId = 1234
     * $query->filterByUsuarioId(array(12, 34)); // WHERE UsuarioId IN (12, 34)
     * $query->filterByUsuarioId(array('min' => 12)); // WHERE UsuarioId > 12
     * </code>
     *
     * @see       filterByUsuario()
     *
     * @param     mixed $usuarioId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByUsuarioId($usuarioId = null, $comparison = null)
    {
        if (is_array($usuarioId)) {
            $useMinMax = false;
            if (isset($usuarioId['min'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_USUARIOID, $usuarioId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuarioId['max'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_USUARIOID, $usuarioId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestamoTableMap::COL_USUARIOID, $usuarioId, $comparison);
    }

    /**
     * Filter the query on the LibroId column
     *
     * Example usage:
     * <code>
     * $query->filterByLibroId(1234); // WHERE LibroId = 1234
     * $query->filterByLibroId(array(12, 34)); // WHERE LibroId IN (12, 34)
     * $query->filterByLibroId(array('min' => 12)); // WHERE LibroId > 12
     * </code>
     *
     * @see       filterByLibro()
     *
     * @param     mixed $libroId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByLibroId($libroId = null, $comparison = null)
    {
        if (is_array($libroId)) {
            $useMinMax = false;
            if (isset($libroId['min'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_LIBROID, $libroId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($libroId['max'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_LIBROID, $libroId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestamoTableMap::COL_LIBROID, $libroId, $comparison);
    }

    /**
     * Filter the query on the VideoBeanId column
     *
     * Example usage:
     * <code>
     * $query->filterByVideoBeanId(1234); // WHERE VideoBeanId = 1234
     * $query->filterByVideoBeanId(array(12, 34)); // WHERE VideoBeanId IN (12, 34)
     * $query->filterByVideoBeanId(array('min' => 12)); // WHERE VideoBeanId > 12
     * </code>
     *
     * @see       filterByVideoBean()
     *
     * @param     mixed $videoBeanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByVideoBeanId($videoBeanId = null, $comparison = null)
    {
        if (is_array($videoBeanId)) {
            $useMinMax = false;
            if (isset($videoBeanId['min'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_VIDEOBEANID, $videoBeanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($videoBeanId['max'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_VIDEOBEANID, $videoBeanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestamoTableMap::COL_VIDEOBEANID, $videoBeanId, $comparison);
    }

    /**
     * Filter the query on the TablaDibujoId column
     *
     * Example usage:
     * <code>
     * $query->filterByTablaDibujoId(1234); // WHERE TablaDibujoId = 1234
     * $query->filterByTablaDibujoId(array(12, 34)); // WHERE TablaDibujoId IN (12, 34)
     * $query->filterByTablaDibujoId(array('min' => 12)); // WHERE TablaDibujoId > 12
     * </code>
     *
     * @see       filterByTablaDibujo()
     *
     * @param     mixed $tablaDibujoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByTablaDibujoId($tablaDibujoId = null, $comparison = null)
    {
        if (is_array($tablaDibujoId)) {
            $useMinMax = false;
            if (isset($tablaDibujoId['min'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_TABLADIBUJOID, $tablaDibujoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tablaDibujoId['max'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_TABLADIBUJOID, $tablaDibujoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestamoTableMap::COL_TABLADIBUJOID, $tablaDibujoId, $comparison);
    }

    /**
     * Filter the query on the FechaReserva column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaReserva('2011-03-14'); // WHERE FechaReserva = '2011-03-14'
     * $query->filterByFechaReserva('now'); // WHERE FechaReserva = '2011-03-14'
     * $query->filterByFechaReserva(array('max' => 'yesterday')); // WHERE FechaReserva > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaReserva The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByFechaReserva($fechaReserva = null, $comparison = null)
    {
        if (is_array($fechaReserva)) {
            $useMinMax = false;
            if (isset($fechaReserva['min'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_FECHARESERVA, $fechaReserva['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaReserva['max'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_FECHARESERVA, $fechaReserva['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestamoTableMap::COL_FECHARESERVA, $fechaReserva, $comparison);
    }

    /**
     * Filter the query on the FechaPrestamo column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaPrestamo('2011-03-14'); // WHERE FechaPrestamo = '2011-03-14'
     * $query->filterByFechaPrestamo('now'); // WHERE FechaPrestamo = '2011-03-14'
     * $query->filterByFechaPrestamo(array('max' => 'yesterday')); // WHERE FechaPrestamo > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaPrestamo The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByFechaPrestamo($fechaPrestamo = null, $comparison = null)
    {
        if (is_array($fechaPrestamo)) {
            $useMinMax = false;
            if (isset($fechaPrestamo['min'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_FECHAPRESTAMO, $fechaPrestamo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaPrestamo['max'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_FECHAPRESTAMO, $fechaPrestamo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestamoTableMap::COL_FECHAPRESTAMO, $fechaPrestamo, $comparison);
    }

    /**
     * Filter the query on the FechaDevolucion column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaDevolucion('2011-03-14'); // WHERE FechaDevolucion = '2011-03-14'
     * $query->filterByFechaDevolucion('now'); // WHERE FechaDevolucion = '2011-03-14'
     * $query->filterByFechaDevolucion(array('max' => 'yesterday')); // WHERE FechaDevolucion > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaDevolucion The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByFechaDevolucion($fechaDevolucion = null, $comparison = null)
    {
        if (is_array($fechaDevolucion)) {
            $useMinMax = false;
            if (isset($fechaDevolucion['min'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_FECHADEVOLUCION, $fechaDevolucion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaDevolucion['max'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_FECHADEVOLUCION, $fechaDevolucion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestamoTableMap::COL_FECHADEVOLUCION, $fechaDevolucion, $comparison);
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
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByEstado($estado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestamoTableMap::COL_ESTADO, $estado, $comparison);
    }

    /**
     * Filter the query on the Sancion column
     *
     * Example usage:
     * <code>
     * $query->filterBySancion(1234); // WHERE Sancion = 1234
     * $query->filterBySancion(array(12, 34)); // WHERE Sancion IN (12, 34)
     * $query->filterBySancion(array('min' => 12)); // WHERE Sancion > 12
     * </code>
     *
     * @param     mixed $sancion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterBySancion($sancion = null, $comparison = null)
    {
        if (is_array($sancion)) {
            $useMinMax = false;
            if (isset($sancion['min'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_SANCION, $sancion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sancion['max'])) {
                $this->addUsingAlias(PrestamoTableMap::COL_SANCION, $sancion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestamoTableMap::COL_SANCION, $sancion, $comparison);
    }

    /**
     * Filter the query by a related \TablaDibujo object
     *
     * @param \TablaDibujo|ObjectCollection $tablaDibujo The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByTablaDibujo($tablaDibujo, $comparison = null)
    {
        if ($tablaDibujo instanceof \TablaDibujo) {
            return $this
                ->addUsingAlias(PrestamoTableMap::COL_TABLADIBUJOID, $tablaDibujo->getId(), $comparison);
        } elseif ($tablaDibujo instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PrestamoTableMap::COL_TABLADIBUJOID, $tablaDibujo->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTablaDibujo() only accepts arguments of type \TablaDibujo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TablaDibujo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function joinTablaDibujo($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TablaDibujo');

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
            $this->addJoinObject($join, 'TablaDibujo');
        }

        return $this;
    }

    /**
     * Use the TablaDibujo relation TablaDibujo object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TablaDibujoQuery A secondary query class using the current class as primary query
     */
    public function useTablaDibujoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTablaDibujo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TablaDibujo', '\TablaDibujoQuery');
    }

    /**
     * Filter the query by a related \VideoBean object
     *
     * @param \VideoBean|ObjectCollection $videoBean The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByVideoBean($videoBean, $comparison = null)
    {
        if ($videoBean instanceof \VideoBean) {
            return $this
                ->addUsingAlias(PrestamoTableMap::COL_VIDEOBEANID, $videoBean->getId(), $comparison);
        } elseif ($videoBean instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PrestamoTableMap::COL_VIDEOBEANID, $videoBean->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVideoBean() only accepts arguments of type \VideoBean or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VideoBean relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function joinVideoBean($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VideoBean');

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
            $this->addJoinObject($join, 'VideoBean');
        }

        return $this;
    }

    /**
     * Use the VideoBean relation VideoBean object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \VideoBeanQuery A secondary query class using the current class as primary query
     */
    public function useVideoBeanQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVideoBean($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VideoBean', '\VideoBeanQuery');
    }

    /**
     * Filter the query by a related \Libro object
     *
     * @param \Libro|ObjectCollection $libro The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByLibro($libro, $comparison = null)
    {
        if ($libro instanceof \Libro) {
            return $this
                ->addUsingAlias(PrestamoTableMap::COL_LIBROID, $libro->getId(), $comparison);
        } elseif ($libro instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PrestamoTableMap::COL_LIBROID, $libro->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLibro() only accepts arguments of type \Libro or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Libro relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function joinLibro($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Libro');

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
            $this->addJoinObject($join, 'Libro');
        }

        return $this;
    }

    /**
     * Use the Libro relation Libro object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LibroQuery A secondary query class using the current class as primary query
     */
    public function useLibroQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLibro($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Libro', '\LibroQuery');
    }

    /**
     * Filter the query by a related \Usuario object
     *
     * @param \Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPrestamoQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(PrestamoTableMap::COL_USUARIOID, $usuario->getId(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PrestamoTableMap::COL_USUARIOID, $usuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsuario() only accepts arguments of type \Usuario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function joinUsuario($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuario');

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
            $this->addJoinObject($join, 'Usuario');
        }

        return $this;
    }

    /**
     * Use the Usuario relation Usuario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuario', '\UsuarioQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPrestamo $prestamo Object to remove from the list of results
     *
     * @return $this|ChildPrestamoQuery The current query, for fluid interface
     */
    public function prune($prestamo = null)
    {
        if ($prestamo) {
            $this->addUsingAlias(PrestamoTableMap::COL_ID, $prestamo->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Prestamo table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrestamoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PrestamoTableMap::clearInstancePool();
            PrestamoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PrestamoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PrestamoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PrestamoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PrestamoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PrestamoQuery
