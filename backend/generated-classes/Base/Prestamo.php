<?php

namespace Base;

use \Libro as ChildLibro;
use \LibroQuery as ChildLibroQuery;
use \PrestamoQuery as ChildPrestamoQuery;
use \TablaDibujo as ChildTablaDibujo;
use \TablaDibujoQuery as ChildTablaDibujoQuery;
use \Usuario as ChildUsuario;
use \UsuarioQuery as ChildUsuarioQuery;
use \VideoBean as ChildVideoBean;
use \VideoBeanQuery as ChildVideoBeanQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\PrestamoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'Prestamo' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Prestamo implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PrestamoTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the usuarioid field.
     *
     * @var        int
     */
    protected $usuarioid;

    /**
     * The value for the libroid field.
     *
     * @var        int
     */
    protected $libroid;

    /**
     * The value for the videobeanid field.
     *
     * @var        int
     */
    protected $videobeanid;

    /**
     * The value for the tabladibujoid field.
     *
     * @var        int
     */
    protected $tabladibujoid;

    /**
     * The value for the fechareserva field.
     *
     * @var        DateTime
     */
    protected $fechareserva;

    /**
     * The value for the fechaprestamo field.
     *
     * @var        DateTime
     */
    protected $fechaprestamo;

    /**
     * The value for the fechadevolucion field.
     *
     * @var        DateTime
     */
    protected $fechadevolucion;

    /**
     * The value for the estado field.
     *
     * @var        string
     */
    protected $estado;

    /**
     * The value for the sancion field.
     *
     * @var        string
     */
    protected $sancion;

    /**
     * @var        ChildTablaDibujo
     */
    protected $aTablaDibujo;

    /**
     * @var        ChildVideoBean
     */
    protected $aVideoBean;

    /**
     * @var        ChildLibro
     */
    protected $aLibro;

    /**
     * @var        ChildUsuario
     */
    protected $aUsuario;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Prestamo object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Prestamo</code> instance.  If
     * <code>obj</code> is an instance of <code>Prestamo</code>, delegates to
     * <code>equals(Prestamo)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Prestamo The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [usuarioid] column value.
     *
     * @return int
     */
    public function getUsuarioId()
    {
        return $this->usuarioid;
    }

    /**
     * Get the [libroid] column value.
     *
     * @return int
     */
    public function getLibroId()
    {
        return $this->libroid;
    }

    /**
     * Get the [videobeanid] column value.
     *
     * @return int
     */
    public function getVideoBeanId()
    {
        return $this->videobeanid;
    }

    /**
     * Get the [tabladibujoid] column value.
     *
     * @return int
     */
    public function getTablaDibujoId()
    {
        return $this->tabladibujoid;
    }

    /**
     * Get the [optionally formatted] temporal [fechareserva] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaReserva($format = NULL)
    {
        if ($format === null) {
            return $this->fechareserva;
        } else {
            return $this->fechareserva instanceof \DateTimeInterface ? $this->fechareserva->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [fechaprestamo] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaPrestamo($format = NULL)
    {
        if ($format === null) {
            return $this->fechaprestamo;
        } else {
            return $this->fechaprestamo instanceof \DateTimeInterface ? $this->fechaprestamo->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [fechadevolucion] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaDevolucion($format = NULL)
    {
        if ($format === null) {
            return $this->fechadevolucion;
        } else {
            return $this->fechadevolucion instanceof \DateTimeInterface ? $this->fechadevolucion->format($format) : null;
        }
    }

    /**
     * Get the [estado] column value.
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Get the [sancion] column value.
     *
     * @return string
     */
    public function getSancion()
    {
        return $this->sancion;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Prestamo The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PrestamoTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [usuarioid] column.
     *
     * @param int $v new value
     * @return $this|\Prestamo The current object (for fluent API support)
     */
    public function setUsuarioId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usuarioid !== $v) {
            $this->usuarioid = $v;
            $this->modifiedColumns[PrestamoTableMap::COL_USUARIOID] = true;
        }

        if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
            $this->aUsuario = null;
        }

        return $this;
    } // setUsuarioId()

    /**
     * Set the value of [libroid] column.
     *
     * @param int $v new value
     * @return $this|\Prestamo The current object (for fluent API support)
     */
    public function setLibroId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->libroid !== $v) {
            $this->libroid = $v;
            $this->modifiedColumns[PrestamoTableMap::COL_LIBROID] = true;
        }

        if ($this->aLibro !== null && $this->aLibro->getId() !== $v) {
            $this->aLibro = null;
        }

        return $this;
    } // setLibroId()

    /**
     * Set the value of [videobeanid] column.
     *
     * @param int $v new value
     * @return $this|\Prestamo The current object (for fluent API support)
     */
    public function setVideoBeanId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->videobeanid !== $v) {
            $this->videobeanid = $v;
            $this->modifiedColumns[PrestamoTableMap::COL_VIDEOBEANID] = true;
        }

        if ($this->aVideoBean !== null && $this->aVideoBean->getId() !== $v) {
            $this->aVideoBean = null;
        }

        return $this;
    } // setVideoBeanId()

    /**
     * Set the value of [tabladibujoid] column.
     *
     * @param int $v new value
     * @return $this|\Prestamo The current object (for fluent API support)
     */
    public function setTablaDibujoId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->tabladibujoid !== $v) {
            $this->tabladibujoid = $v;
            $this->modifiedColumns[PrestamoTableMap::COL_TABLADIBUJOID] = true;
        }

        if ($this->aTablaDibujo !== null && $this->aTablaDibujo->getId() !== $v) {
            $this->aTablaDibujo = null;
        }

        return $this;
    } // setTablaDibujoId()

    /**
     * Sets the value of [fechareserva] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Prestamo The current object (for fluent API support)
     */
    public function setFechaReserva($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fechareserva !== null || $dt !== null) {
            if ($this->fechareserva === null || $dt === null || $dt->format("Y-m-d") !== $this->fechareserva->format("Y-m-d")) {
                $this->fechareserva = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PrestamoTableMap::COL_FECHARESERVA] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaReserva()

    /**
     * Sets the value of [fechaprestamo] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Prestamo The current object (for fluent API support)
     */
    public function setFechaPrestamo($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fechaprestamo !== null || $dt !== null) {
            if ($this->fechaprestamo === null || $dt === null || $dt->format("Y-m-d") !== $this->fechaprestamo->format("Y-m-d")) {
                $this->fechaprestamo = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PrestamoTableMap::COL_FECHAPRESTAMO] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaPrestamo()

    /**
     * Sets the value of [fechadevolucion] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Prestamo The current object (for fluent API support)
     */
    public function setFechaDevolucion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fechadevolucion !== null || $dt !== null) {
            if ($this->fechadevolucion === null || $dt === null || $dt->format("Y-m-d") !== $this->fechadevolucion->format("Y-m-d")) {
                $this->fechadevolucion = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PrestamoTableMap::COL_FECHADEVOLUCION] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaDevolucion()

    /**
     * Set the value of [estado] column.
     *
     * @param string $v new value
     * @return $this|\Prestamo The current object (for fluent API support)
     */
    public function setEstado($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->estado !== $v) {
            $this->estado = $v;
            $this->modifiedColumns[PrestamoTableMap::COL_ESTADO] = true;
        }

        return $this;
    } // setEstado()

    /**
     * Set the value of [sancion] column.
     *
     * @param string $v new value
     * @return $this|\Prestamo The current object (for fluent API support)
     */
    public function setSancion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sancion !== $v) {
            $this->sancion = $v;
            $this->modifiedColumns[PrestamoTableMap::COL_SANCION] = true;
        }

        return $this;
    } // setSancion()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PrestamoTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PrestamoTableMap::translateFieldName('UsuarioId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->usuarioid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PrestamoTableMap::translateFieldName('LibroId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->libroid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PrestamoTableMap::translateFieldName('VideoBeanId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->videobeanid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PrestamoTableMap::translateFieldName('TablaDibujoId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tabladibujoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PrestamoTableMap::translateFieldName('FechaReserva', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fechareserva = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PrestamoTableMap::translateFieldName('FechaPrestamo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fechaprestamo = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PrestamoTableMap::translateFieldName('FechaDevolucion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fechadevolucion = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PrestamoTableMap::translateFieldName('Estado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->estado = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PrestamoTableMap::translateFieldName('Sancion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sancion = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = PrestamoTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Prestamo'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aUsuario !== null && $this->usuarioid !== $this->aUsuario->getId()) {
            $this->aUsuario = null;
        }
        if ($this->aLibro !== null && $this->libroid !== $this->aLibro->getId()) {
            $this->aLibro = null;
        }
        if ($this->aVideoBean !== null && $this->videobeanid !== $this->aVideoBean->getId()) {
            $this->aVideoBean = null;
        }
        if ($this->aTablaDibujo !== null && $this->tabladibujoid !== $this->aTablaDibujo->getId()) {
            $this->aTablaDibujo = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PrestamoTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPrestamoQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTablaDibujo = null;
            $this->aVideoBean = null;
            $this->aLibro = null;
            $this->aUsuario = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Prestamo::setDeleted()
     * @see Prestamo::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrestamoTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPrestamoQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrestamoTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PrestamoTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aTablaDibujo !== null) {
                if ($this->aTablaDibujo->isModified() || $this->aTablaDibujo->isNew()) {
                    $affectedRows += $this->aTablaDibujo->save($con);
                }
                $this->setTablaDibujo($this->aTablaDibujo);
            }

            if ($this->aVideoBean !== null) {
                if ($this->aVideoBean->isModified() || $this->aVideoBean->isNew()) {
                    $affectedRows += $this->aVideoBean->save($con);
                }
                $this->setVideoBean($this->aVideoBean);
            }

            if ($this->aLibro !== null) {
                if ($this->aLibro->isModified() || $this->aLibro->isNew()) {
                    $affectedRows += $this->aLibro->save($con);
                }
                $this->setLibro($this->aLibro);
            }

            if ($this->aUsuario !== null) {
                if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
                    $affectedRows += $this->aUsuario->save($con);
                }
                $this->setUsuario($this->aUsuario);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[PrestamoTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PrestamoTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PrestamoTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'Id';
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_USUARIOID)) {
            $modifiedColumns[':p' . $index++]  = 'UsuarioId';
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_LIBROID)) {
            $modifiedColumns[':p' . $index++]  = 'LibroId';
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_VIDEOBEANID)) {
            $modifiedColumns[':p' . $index++]  = 'VideoBeanId';
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_TABLADIBUJOID)) {
            $modifiedColumns[':p' . $index++]  = 'TablaDibujoId';
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_FECHARESERVA)) {
            $modifiedColumns[':p' . $index++]  = 'FechaReserva';
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_FECHAPRESTAMO)) {
            $modifiedColumns[':p' . $index++]  = 'FechaPrestamo';
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_FECHADEVOLUCION)) {
            $modifiedColumns[':p' . $index++]  = 'FechaDevolucion';
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = 'Estado';
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_SANCION)) {
            $modifiedColumns[':p' . $index++]  = 'Sancion';
        }

        $sql = sprintf(
            'INSERT INTO Prestamo (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'Id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'UsuarioId':
                        $stmt->bindValue($identifier, $this->usuarioid, PDO::PARAM_INT);
                        break;
                    case 'LibroId':
                        $stmt->bindValue($identifier, $this->libroid, PDO::PARAM_INT);
                        break;
                    case 'VideoBeanId':
                        $stmt->bindValue($identifier, $this->videobeanid, PDO::PARAM_INT);
                        break;
                    case 'TablaDibujoId':
                        $stmt->bindValue($identifier, $this->tabladibujoid, PDO::PARAM_INT);
                        break;
                    case 'FechaReserva':
                        $stmt->bindValue($identifier, $this->fechareserva ? $this->fechareserva->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'FechaPrestamo':
                        $stmt->bindValue($identifier, $this->fechaprestamo ? $this->fechaprestamo->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'FechaDevolucion':
                        $stmt->bindValue($identifier, $this->fechadevolucion ? $this->fechadevolucion->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'Estado':
                        $stmt->bindValue($identifier, $this->estado, PDO::PARAM_STR);
                        break;
                    case 'Sancion':
                        $stmt->bindValue($identifier, $this->sancion, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PrestamoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getUsuarioId();
                break;
            case 2:
                return $this->getLibroId();
                break;
            case 3:
                return $this->getVideoBeanId();
                break;
            case 4:
                return $this->getTablaDibujoId();
                break;
            case 5:
                return $this->getFechaReserva();
                break;
            case 6:
                return $this->getFechaPrestamo();
                break;
            case 7:
                return $this->getFechaDevolucion();
                break;
            case 8:
                return $this->getEstado();
                break;
            case 9:
                return $this->getSancion();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Prestamo'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Prestamo'][$this->hashCode()] = true;
        $keys = PrestamoTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUsuarioId(),
            $keys[2] => $this->getLibroId(),
            $keys[3] => $this->getVideoBeanId(),
            $keys[4] => $this->getTablaDibujoId(),
            $keys[5] => $this->getFechaReserva(),
            $keys[6] => $this->getFechaPrestamo(),
            $keys[7] => $this->getFechaDevolucion(),
            $keys[8] => $this->getEstado(),
            $keys[9] => $this->getSancion(),
        );
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('c');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aTablaDibujo) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tablaDibujo';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'TablaDibujo';
                        break;
                    default:
                        $key = 'TablaDibujo';
                }

                $result[$key] = $this->aTablaDibujo->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aVideoBean) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'videoBean';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'VideoBean';
                        break;
                    default:
                        $key = 'VideoBean';
                }

                $result[$key] = $this->aVideoBean->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLibro) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'libro';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Libro';
                        break;
                    default:
                        $key = 'Libro';
                }

                $result[$key] = $this->aLibro->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUsuario) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'usuario';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Usuario';
                        break;
                    default:
                        $key = 'Usuario';
                }

                $result[$key] = $this->aUsuario->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Prestamo
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PrestamoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Prestamo
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUsuarioId($value);
                break;
            case 2:
                $this->setLibroId($value);
                break;
            case 3:
                $this->setVideoBeanId($value);
                break;
            case 4:
                $this->setTablaDibujoId($value);
                break;
            case 5:
                $this->setFechaReserva($value);
                break;
            case 6:
                $this->setFechaPrestamo($value);
                break;
            case 7:
                $this->setFechaDevolucion($value);
                break;
            case 8:
                $this->setEstado($value);
                break;
            case 9:
                $this->setSancion($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PrestamoTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUsuarioId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setLibroId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setVideoBeanId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTablaDibujoId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFechaReserva($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFechaPrestamo($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setFechaDevolucion($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setEstado($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setSancion($arr[$keys[9]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Prestamo The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PrestamoTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PrestamoTableMap::COL_ID)) {
            $criteria->add(PrestamoTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_USUARIOID)) {
            $criteria->add(PrestamoTableMap::COL_USUARIOID, $this->usuarioid);
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_LIBROID)) {
            $criteria->add(PrestamoTableMap::COL_LIBROID, $this->libroid);
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_VIDEOBEANID)) {
            $criteria->add(PrestamoTableMap::COL_VIDEOBEANID, $this->videobeanid);
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_TABLADIBUJOID)) {
            $criteria->add(PrestamoTableMap::COL_TABLADIBUJOID, $this->tabladibujoid);
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_FECHARESERVA)) {
            $criteria->add(PrestamoTableMap::COL_FECHARESERVA, $this->fechareserva);
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_FECHAPRESTAMO)) {
            $criteria->add(PrestamoTableMap::COL_FECHAPRESTAMO, $this->fechaprestamo);
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_FECHADEVOLUCION)) {
            $criteria->add(PrestamoTableMap::COL_FECHADEVOLUCION, $this->fechadevolucion);
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_ESTADO)) {
            $criteria->add(PrestamoTableMap::COL_ESTADO, $this->estado);
        }
        if ($this->isColumnModified(PrestamoTableMap::COL_SANCION)) {
            $criteria->add(PrestamoTableMap::COL_SANCION, $this->sancion);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildPrestamoQuery::create();
        $criteria->add(PrestamoTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Prestamo (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUsuarioId($this->getUsuarioId());
        $copyObj->setLibroId($this->getLibroId());
        $copyObj->setVideoBeanId($this->getVideoBeanId());
        $copyObj->setTablaDibujoId($this->getTablaDibujoId());
        $copyObj->setFechaReserva($this->getFechaReserva());
        $copyObj->setFechaPrestamo($this->getFechaPrestamo());
        $copyObj->setFechaDevolucion($this->getFechaDevolucion());
        $copyObj->setEstado($this->getEstado());
        $copyObj->setSancion($this->getSancion());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Prestamo Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildTablaDibujo object.
     *
     * @param  ChildTablaDibujo $v
     * @return $this|\Prestamo The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTablaDibujo(ChildTablaDibujo $v = null)
    {
        if ($v === null) {
            $this->setTablaDibujoId(NULL);
        } else {
            $this->setTablaDibujoId($v->getId());
        }

        $this->aTablaDibujo = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTablaDibujo object, it will not be re-added.
        if ($v !== null) {
            $v->addPrestamo($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTablaDibujo object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildTablaDibujo The associated ChildTablaDibujo object.
     * @throws PropelException
     */
    public function getTablaDibujo(ConnectionInterface $con = null)
    {
        if ($this->aTablaDibujo === null && ($this->tabladibujoid != 0)) {
            $this->aTablaDibujo = ChildTablaDibujoQuery::create()->findPk($this->tabladibujoid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTablaDibujo->addPrestamos($this);
             */
        }

        return $this->aTablaDibujo;
    }

    /**
     * Declares an association between this object and a ChildVideoBean object.
     *
     * @param  ChildVideoBean $v
     * @return $this|\Prestamo The current object (for fluent API support)
     * @throws PropelException
     */
    public function setVideoBean(ChildVideoBean $v = null)
    {
        if ($v === null) {
            $this->setVideoBeanId(NULL);
        } else {
            $this->setVideoBeanId($v->getId());
        }

        $this->aVideoBean = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildVideoBean object, it will not be re-added.
        if ($v !== null) {
            $v->addPrestamo($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildVideoBean object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildVideoBean The associated ChildVideoBean object.
     * @throws PropelException
     */
    public function getVideoBean(ConnectionInterface $con = null)
    {
        if ($this->aVideoBean === null && ($this->videobeanid != 0)) {
            $this->aVideoBean = ChildVideoBeanQuery::create()->findPk($this->videobeanid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVideoBean->addPrestamos($this);
             */
        }

        return $this->aVideoBean;
    }

    /**
     * Declares an association between this object and a ChildLibro object.
     *
     * @param  ChildLibro $v
     * @return $this|\Prestamo The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLibro(ChildLibro $v = null)
    {
        if ($v === null) {
            $this->setLibroId(NULL);
        } else {
            $this->setLibroId($v->getId());
        }

        $this->aLibro = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildLibro object, it will not be re-added.
        if ($v !== null) {
            $v->addPrestamo($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildLibro object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildLibro The associated ChildLibro object.
     * @throws PropelException
     */
    public function getLibro(ConnectionInterface $con = null)
    {
        if ($this->aLibro === null && ($this->libroid != 0)) {
            $this->aLibro = ChildLibroQuery::create()->findPk($this->libroid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLibro->addPrestamos($this);
             */
        }

        return $this->aLibro;
    }

    /**
     * Declares an association between this object and a ChildUsuario object.
     *
     * @param  ChildUsuario $v
     * @return $this|\Prestamo The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsuario(ChildUsuario $v = null)
    {
        if ($v === null) {
            $this->setUsuarioId(NULL);
        } else {
            $this->setUsuarioId($v->getId());
        }

        $this->aUsuario = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsuario object, it will not be re-added.
        if ($v !== null) {
            $v->addPrestamo($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsuario object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUsuario The associated ChildUsuario object.
     * @throws PropelException
     */
    public function getUsuario(ConnectionInterface $con = null)
    {
        if ($this->aUsuario === null && ($this->usuarioid != 0)) {
            $this->aUsuario = ChildUsuarioQuery::create()->findPk($this->usuarioid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsuario->addPrestamos($this);
             */
        }

        return $this->aUsuario;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aTablaDibujo) {
            $this->aTablaDibujo->removePrestamo($this);
        }
        if (null !== $this->aVideoBean) {
            $this->aVideoBean->removePrestamo($this);
        }
        if (null !== $this->aLibro) {
            $this->aLibro->removePrestamo($this);
        }
        if (null !== $this->aUsuario) {
            $this->aUsuario->removePrestamo($this);
        }
        $this->id = null;
        $this->usuarioid = null;
        $this->libroid = null;
        $this->videobeanid = null;
        $this->tabladibujoid = null;
        $this->fechareserva = null;
        $this->fechaprestamo = null;
        $this->fechadevolucion = null;
        $this->estado = null;
        $this->sancion = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aTablaDibujo = null;
        $this->aVideoBean = null;
        $this->aLibro = null;
        $this->aUsuario = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PrestamoTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
