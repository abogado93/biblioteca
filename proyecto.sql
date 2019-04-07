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

