CREATE DATABASE quodlibet WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.UTF-8' LC_CTYPE = 'en_US.UTF-8';


CREATE TABLE public.clientes (
    id integer NOT NULL,
    ruc character varying(20),
    nombre_fantasia character varying(200),
    razon_social character varying(200),
    email character varying(200),
    telefono character varying(100),
    direccion character varying(200),
    observaciones text,
    ts_alta timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    usuario_alta integer
);

CREATE SEQUENCE public.clients_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    usuario character varying(100),
    nombres character varying(200),
    apellidos character varying(200),
    password character varying(100),
    salt character varying(100),
    ultimo_acceso timestamp without time zone,
    acceso_intentos smallint,
    bloqueado boolean,
    bloqueado_ts timestamp without time zone,
    ts_alta timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    ts_baja timestamp without time zone
);



CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;





CREATE TABLE "devoluciones" (

"id" int4 NOT NULL DEFAULT nextval('devoluciones_id_seq'::regclass),

"fecha_devolucion" date,

"devolucion_devolucion" date,

"persona_devolucion" numeric(50),

"estado_devolucion" varchar(10),

"id_libro_devolucion" numeric(50),

CONSTRAINT "devoluciones_pkey" PRIMARY KEY ("id") 

);



CREATE TABLE "libros" (

"id" int4 NOT NULL DEFAULT nextval('libros_id_seq'::regclass),

"nombre_libro" varchar(200),

"fecha_libro" date,

"tipo_libro" numeric(50),

"estado_libro" numeric(50),

"precio_libro" numeric(50),

"existencia_libro" numeric(50),

"cantidad_libro" numeric(50),

CONSTRAINT "libros_pkey" PRIMARY KEY ("id") 

);



CREATE TABLE "pagos" (

"id" int4 NOT NULL DEFAULT nextval('pagos_id_seq'::regclass),

"fecha_pago" date,

"multa_pago" numeric(50),

"monto_pago" numeric(50),

"id_prestamo_pago" numeric(50),

"estado_pago" varchar(100),

CONSTRAINT "pagos_pkey" PRIMARY KEY ("id") 

);



CREATE TABLE "personas" (

"id" int4 NOT NULL DEFAULT nextval('personas_id_seq'::regclass),

"nombre_persona" varchar(100),

"apellido_persona" varchar(100),

"cedula_persona" numeric(50),

"sexo_persona" varchar(10),

"direccion_persona" varchar(200),

CONSTRAINT "personas_pkey" PRIMARY KEY ("id") 

);



CREATE TABLE "prestamos" (

"id" int4 NOT NULL DEFAULT nextval('prestamos_id_seq'::regclass),

"fecha_pres" date,

"estado_pres" varchar(50),

"presona_pres" numeric(50),

"libro_id_pres" numeric(50),

"devolucion_pres" numeric(50),

"dias_pres" numeric(50),

"cantidad_pres" numeric(50),

CONSTRAINT "prestamos_pkey" PRIMARY KEY ("id") 

);



CREATE TABLE "tipo_libros" (

"id" int4 NOT NULL DEFAULT nextval('tipo_libros_id_seq'::regclass),

"descripcion_tipo" varchar(100),

CONSTRAINT "tipo_libros_pkey" PRIMARY KEY ("id") 

);









ALTER TABLE "libros" ADD CONSTRAINT "fk_libros_libros_1" FOREIGN KEY ("id") REFERENCES "devoluciones" ("id", "id_libro_devolucion");

ALTER TABLE "tipo_libros" ADD CONSTRAINT "fk_tipo_libros_tipo_libros_1" FOREIGN KEY ("id") REFERENCES "libros" ("id", "tipo_libro");

ALTER TABLE "libros" ADD FOREIGN KEY ("id") REFERENCES "prestamos" ("libro_id_pres");

ALTER TABLE "personas" ADD CONSTRAINT "fk_personas_personas_1" FOREIGN KEY ("id") REFERENCES "prestamos" ("id", "presona_pres");

ALTER TABLE "prestamos" ADD CONSTRAINT "fk_prestamos_prestamos_1" FOREIGN KEY ("id") REFERENCES "pagos" ("id", "id_prestamo_pago");




ALTER TABLE ONLY public.clientes ALTER COLUMN id SET DEFAULT nextval('public.clients_id_seq'::regclass);


ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_pk PRIMARY KEY (id);


ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_ruc_unique UNIQUE (ruc);


ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pk PRIMARY KEY (id);


ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_unique UNIQUE (usuario);


ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT usuarios_clientes_fk FOREIGN KEY (usuario_alta) REFERENCES public.usuarios(id);

