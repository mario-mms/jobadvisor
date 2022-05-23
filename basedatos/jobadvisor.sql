create user jobadvisor@localhost identified by 'jobadvisor';
create database jobadvisor;
use jobadvisor;
grant all on jobadvisor.* to jobadvisor@localhost;

create table candidatos(
    id_candidato int auto_increment ,
    nombre varchar(40) not null ,
    apellido1 varchar(40) not null ,
    apellido2 varchar (40) not null ,
    nif char(9) not null unique ,
    telefono int(9) not null unique ,
    email varchar(100) not null unique ,
    password varchar(200) not null ,
    constraint candidatos_pk primary key (id_candidato)
);

create table cv(
  id_cv int auto_increment,
  id_candidato int,
  fecha_actual date,
  provincia varchar(50),
  constraint cv_pk primary key (id_cv,id_candidato),
  constraint cv_fk foreign key (id_candidato) references candidatos(id_candidato)
);

create table experiencia(
    id_experiencia int auto_increment,
    id_cv int,
    experiencia varchar(1000),
    constraint experiencia_pk primary key (id_experiencia,id_cv),
    constraint experiencia_fk foreign key (id_cv) references cv(id_cv)
);

create table titulacion(
    id_titulacion int auto_increment,
    id_cv int,
    titulacion varchar(1000),
    constraint titulacion_pk primary key (id_titulacion,id_cv),
    constraint titulacion_fk foreign key (id_cv) references cv(id_cv)
);

create table masinfo(
    id_masinfo int auto_increment,
    id_cv int,
    masinfo varchar(1000),
    constraint masinfo_pk primary key (id_masinfo,id_cv),
    constraint masinfo_fk foreign key (id_cv) references cv(id_cv)
);

create table empresas(
  id_empresa int auto_increment,
  nombre varchar(100) not null unique ,
  cif int,
  telefono int(9) not null unique ,
  informacion varchar(1000),
  email varchar(100) not null unique ,
  password varchar(200),
  constraint empresas_pk primary key (id_empresa)
);

create table ofertas(
    id_oferta int auto_increment,
    id_empresa int not null ,
    id_sector int,
    provincia varchar(50),
    fecha_actual date not null ,
    titulo varchar(100) not null ,
    salario varchar(100),
    horario varchar(100),
    duracion varchar(50),
    descripcion varchar(500),
    constraint ofertas_pk primary key (id_oferta,id_empresa),
    constraint ofertas_fk foreign key (id_empresa) references empresas(id_empresa)
);

create table opiniones(
  id_opinion int auto_increment,
  id_empresa int not null ,
  id_candidato int not null ,
  opinion varchar(2000) not null ,
  fecha_actual date not null ,
  puesto varchar(1000),
  inicio_contrato date,
  fin_contrato date,
  constraint opiniones_pk primary key (id_opinion,id_empresa,id_candidato),
  constraint opiniones_fk1 foreign key (id_empresa) references empresas(id_empresa),
  constraint opiniones_fk2 foreign key (id_candidato) references candidatos(id_candidato)
);

create table respuestas(
  id_respuesta int auto_increment,
  id_opinion int not null unique ,
  cabecera varchar(1000) not null ,
  respuesta varchar(2000) not null ,
  constraint respuestas_pk primary key (id_respuesta,id_opinion),
  constraint respuestas_fk foreign key (id_opinion) references opiniones(id_opinion)
);