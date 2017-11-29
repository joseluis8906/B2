<?php

namespace Base;

use \Usuario as ChildUsuario;
use \UsuarioQuery as ChildUsuarioQuery;
use \Exception;
use \PDO;
use Map\UsuarioTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Usuario' table.
 *
 *
 *
 * @method     ChildUsuarioQuery orderById($order = Criteria::ASC) Order by the Id column
 * @method     ChildUsuarioQuery orderByUsername($order = Criteria::ASC) Order by the UserName column
 * @method     ChildUsuarioQuery orderByPassword($order = Criteria::ASC) Order by the Password column
 * @method     ChildUsuarioQuery orderByCedula($order = Criteria::ASC) Order by the Cedula column
 * @method     ChildUsuarioQuery orderByNombre($order = Criteria::ASC) Order by the Nombre column
 * @method     ChildUsuarioQuery orderByApellido($order = Criteria::ASC) Order by the Apellido column
 * @method     ChildUsuarioQuery orderByOcupacion($order = Criteria::ASC) Order by the Ocupacion column
 * @method     ChildUsuarioQuery orderByEmail($order = Criteria::ASC) Order by the Email column
 * @method     ChildUsuarioQuery orderByDireccion($order = Criteria::ASC) Order by the Direccion column
 * @method     ChildUsuarioQuery orderByTelefono($order = Criteria::ASC) Order by the Telefono column
 * @method     ChildUsuarioQuery orderByActivo($order = Criteria::ASC) Order by the Activo column
 *
 * @method     ChildUsuarioQuery groupById() Group by the Id column
 * @method     ChildUsuarioQuery groupByUsername() Group by the UserName column
 * @method     ChildUsuarioQuery groupByPassword() Group by the Password column
 * @method     ChildUsuarioQuery groupByCedula() Group by the Cedula column
 * @method     ChildUsuarioQuery groupByNombre() Group by the Nombre column
 * @method     ChildUsuarioQuery groupByApellido() Group by the Apellido column
 * @method     ChildUsuarioQuery groupByOcupacion() Group by the Ocupacion column
 * @method     ChildUsuarioQuery groupByEmail() Group by the Email column
 * @method     ChildUsuarioQuery groupByDireccion() Group by the Direccion column
 * @method     ChildUsuarioQuery groupByTelefono() Group by the Telefono column
 * @method     ChildUsuarioQuery groupByActivo() Group by the Activo column
 *
 * @method     ChildUsuarioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsuarioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsuarioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsuarioQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsuarioQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsuarioQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsuarioQuery leftJoinUsuarioGrupo($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioGrupo relation
 * @method     ChildUsuarioQuery rightJoinUsuarioGrupo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioGrupo relation
 * @method     ChildUsuarioQuery innerJoinUsuarioGrupo($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioGrupo relation
 *
 * @method     ChildUsuarioQuery joinWithUsuarioGrupo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsuarioGrupo relation
 *
 * @method     ChildUsuarioQuery leftJoinWithUsuarioGrupo() Adds a LEFT JOIN clause and with to the query using the UsuarioGrupo relation
 * @method     ChildUsuarioQuery rightJoinWithUsuarioGrupo() Adds a RIGHT JOIN clause and with to the query using the UsuarioGrupo relation
 * @method     ChildUsuarioQuery innerJoinWithUsuarioGrupo() Adds a INNER JOIN clause and with to the query using the UsuarioGrupo relation
 *
 * @method     ChildUsuarioQuery leftJoinPrestamo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prestamo relation
 * @method     ChildUsuarioQuery rightJoinPrestamo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prestamo relation
 * @method     ChildUsuarioQuery innerJoinPrestamo($relationAlias = null) Adds a INNER JOIN clause to the query using the Prestamo relation
 *
 * @method     ChildUsuarioQuery joinWithPrestamo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prestamo relation
 *
 * @method     ChildUsuarioQuery leftJoinWithPrestamo() Adds a LEFT JOIN clause and with to the query using the Prestamo relation
 * @method     ChildUsuarioQuery rightJoinWithPrestamo() Adds a RIGHT JOIN clause and with to the query using the Prestamo relation
 * @method     ChildUsuarioQuery innerJoinWithPrestamo() Adds a INNER JOIN clause and with to the query using the Prestamo relation
 *
 * @method     \UsuarioGrupoQuery|\PrestamoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsuario findOne(ConnectionInterface $con = null) Return the first ChildUsuario matching the query
 * @method     ChildUsuario findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsuario matching the query, or a new ChildUsuario object populated from the query conditions when no match is found
 *
 * @method     ChildUsuario findOneById(int $Id) Return the first ChildUsuario filtered by the Id column
 * @method     ChildUsuario findOneByUsername(string $UserName) Return the first ChildUsuario filtered by the UserName column
 * @method     ChildUsuario findOneByPassword(string $Password) Return the first ChildUsuario filtered by the Password column
 * @method     ChildUsuario findOneByCedula(string $Cedula) Return the first ChildUsuario filtered by the Cedula column
 * @method     ChildUsuario findOneByNombre(string $Nombre) Return the first ChildUsuario filtered by the Nombre column
 * @method     ChildUsuario findOneByApellido(string $Apellido) Return the first ChildUsuario filtered by the Apellido column
 * @method     ChildUsuario findOneByOcupacion(string $Ocupacion) Return the first ChildUsuario filtered by the Ocupacion column
 * @method     ChildUsuario findOneByEmail(string $Email) Return the first ChildUsuario filtered by the Email column
 * @method     ChildUsuario findOneByDireccion(string $Direccion) Return the first ChildUsuario filtered by the Direccion column
 * @method     ChildUsuario findOneByTelefono(string $Telefono) Return the first ChildUsuario filtered by the Telefono column
 * @method     ChildUsuario findOneByActivo(string $Activo) Return the first ChildUsuario filtered by the Activo column *

 * @method     ChildUsuario requirePk($key, ConnectionInterface $con = null) Return the ChildUsuario by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOne(ConnectionInterface $con = null) Return the first ChildUsuario matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuario requireOneById(int $Id) Return the first ChildUsuario filtered by the Id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByUsername(string $UserName) Return the first ChildUsuario filtered by the UserName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByPassword(string $Password) Return the first ChildUsuario filtered by the Password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByCedula(string $Cedula) Return the first ChildUsuario filtered by the Cedula column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByNombre(string $Nombre) Return the first ChildUsuario filtered by the Nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByApellido(string $Apellido) Return the first ChildUsuario filtered by the Apellido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByOcupacion(string $Ocupacion) Return the first ChildUsuario filtered by the Ocupacion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByEmail(string $Email) Return the first ChildUsuario filtered by the Email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByDireccion(string $Direccion) Return the first ChildUsuario filtered by the Direccion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByTelefono(string $Telefono) Return the first ChildUsuario filtered by the Telefono column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByActivo(string $Activo) Return the first ChildUsuario filtered by the Activo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuario[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsuario objects based on current ModelCriteria
 * @method     ChildUsuario[]|ObjectCollection findById(int $Id) Return ChildUsuario objects filtered by the Id column
 * @method     ChildUsuario[]|ObjectCollection findByUsername(string $UserName) Return ChildUsuario objects filtered by the UserName column
 * @method     ChildUsuario[]|ObjectCollection findByPassword(string $Password) Return ChildUsuario objects filtered by the Password column
 * @method     ChildUsuario[]|ObjectCollection findByCedula(string $Cedula) Return ChildUsuario objects filtered by the Cedula column
 * @method     ChildUsuario[]|ObjectCollection findByNombre(string $Nombre) Return ChildUsuario objects filtered by the Nombre column
 * @method     ChildUsuario[]|ObjectCollection findByApellido(string $Apellido) Return ChildUsuario objects filtered by the Apellido column
 * @method     ChildUsuario[]|ObjectCollection findByOcupacion(string $Ocupacion) Return ChildUsuario objects filtered by the Ocupacion column
 * @method     ChildUsuario[]|ObjectCollection findByEmail(string $Email) Return ChildUsuario objects filtered by the Email column
 * @method     ChildUsuario[]|ObjectCollection findByDireccion(string $Direccion) Return ChildUsuario objects filtered by the Direccion column
 * @method     ChildUsuario[]|ObjectCollection findByTelefono(string $Telefono) Return ChildUsuario objects filtered by the Telefono column
 * @method     ChildUsuario[]|ObjectCollection findByActivo(string $Activo) Return ChildUsuario objects filtered by the Activo column
 * @method     ChildUsuario[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsuarioQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsuarioQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Usuario', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsuarioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsuarioQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsuarioQuery) {
            return $criteria;
        }
        $query = new ChildUsuarioQuery();
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
     * @return ChildUsuario|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsuarioTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsuario A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT Id, UserName, Password, Cedula, Nombre, Apellido, Ocupacion, Email, Direccion, Telefono, Activo FROM Usuario WHERE Id = :p0';
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
            /** @var ChildUsuario $obj */
            $obj = new ChildUsuario();
            $obj->hydrate($row);
            UsuarioTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsuario|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsuarioTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsuarioTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsuarioTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsuarioTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the UserName column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE UserName = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE UserName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the Password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE Password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE Password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the Cedula column
     *
     * Example usage:
     * <code>
     * $query->filterByCedula('fooValue');   // WHERE Cedula = 'fooValue'
     * $query->filterByCedula('%fooValue%', Criteria::LIKE); // WHERE Cedula LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cedula The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByCedula($cedula = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cedula)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_CEDULA, $cedula, $comparison);
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the Apellido column
     *
     * Example usage:
     * <code>
     * $query->filterByApellido('fooValue');   // WHERE Apellido = 'fooValue'
     * $query->filterByApellido('%fooValue%', Criteria::LIKE); // WHERE Apellido LIKE '%fooValue%'
     * </code>
     *
     * @param     string $apellido The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByApellido($apellido = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellido)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_APELLIDO, $apellido, $comparison);
    }

    /**
     * Filter the query on the Ocupacion column
     *
     * Example usage:
     * <code>
     * $query->filterByOcupacion('fooValue');   // WHERE Ocupacion = 'fooValue'
     * $query->filterByOcupacion('%fooValue%', Criteria::LIKE); // WHERE Ocupacion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ocupacion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByOcupacion($ocupacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ocupacion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_OCUPACION, $ocupacion, $comparison);
    }

    /**
     * Filter the query on the Email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE Email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE Email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the Direccion column
     *
     * Example usage:
     * <code>
     * $query->filterByDireccion('fooValue');   // WHERE Direccion = 'fooValue'
     * $query->filterByDireccion('%fooValue%', Criteria::LIKE); // WHERE Direccion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $direccion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByDireccion($direccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($direccion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_DIRECCION, $direccion, $comparison);
    }

    /**
     * Filter the query on the Telefono column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefono('fooValue');   // WHERE Telefono = 'fooValue'
     * $query->filterByTelefono('%fooValue%', Criteria::LIKE); // WHERE Telefono LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefono The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByTelefono($telefono = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefono)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_TELEFONO, $telefono, $comparison);
    }

    /**
     * Filter the query on the Activo column
     *
     * Example usage:
     * <code>
     * $query->filterByActivo('fooValue');   // WHERE Activo = 'fooValue'
     * $query->filterByActivo('%fooValue%', Criteria::LIKE); // WHERE Activo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $activo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByActivo($activo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($activo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_ACTIVO, $activo, $comparison);
    }

    /**
     * Filter the query by a related \UsuarioGrupo object
     *
     * @param \UsuarioGrupo|ObjectCollection $usuarioGrupo the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuarioGrupo($usuarioGrupo, $comparison = null)
    {
        if ($usuarioGrupo instanceof \UsuarioGrupo) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_ID, $usuarioGrupo->getUsuarioId(), $comparison);
        } elseif ($usuarioGrupo instanceof ObjectCollection) {
            return $this
                ->useUsuarioGrupoQuery()
                ->filterByPrimaryKeys($usuarioGrupo->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsuarioGrupo() only accepts arguments of type \UsuarioGrupo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsuarioGrupo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinUsuarioGrupo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsuarioGrupo');

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
            $this->addJoinObject($join, 'UsuarioGrupo');
        }

        return $this;
    }

    /**
     * Use the UsuarioGrupo relation UsuarioGrupo object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsuarioGrupoQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioGrupoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuarioGrupo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioGrupo', '\UsuarioGrupoQuery');
    }

    /**
     * Filter the query by a related \Prestamo object
     *
     * @param \Prestamo|ObjectCollection $prestamo the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPrestamo($prestamo, $comparison = null)
    {
        if ($prestamo instanceof \Prestamo) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_ID, $prestamo->getUsuarioId(), $comparison);
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
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
     * Filter the query by a related Grupo object
     * using the UsuarioGrupo table as cross reference
     *
     * @param Grupo $grupo the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByGrupo($grupo, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useUsuarioGrupoQuery()
            ->filterByGrupo($grupo, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsuario $usuario Object to remove from the list of results
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function prune($usuario = null)
    {
        if ($usuario) {
            $this->addUsingAlias(UsuarioTableMap::COL_ID, $usuario->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Usuario table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsuarioTableMap::clearInstancePool();
            UsuarioTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsuarioTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsuarioTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsuarioTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsuarioQuery
