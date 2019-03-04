/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     04/03/2019 14:58:52                          */
/*==============================================================*/


drop table ANIMAL;

drop table OCORRENCIA;

drop table OCORRENCIATIPO;

drop table PARENTESCO;

drop table PESSOA;

drop table SITUACAO;

drop table UNIDADE;

drop table VACINA;

drop domain DATE;

drop domain "DECIMAL";

drop domain ID;

drop domain NUMBER_1_;

drop domain OBSERVACAO;

drop domain TELEFONE;

drop domain TEXTO_1_;

drop domain TEXTO_255_;

drop domain TEXTO_50_;

/*==============================================================*/
/* Domain: DATE                                                 */
/*==============================================================*/
create domain DATE as DATE;

/*==============================================================*/
/* Domain: "DECIMAL"                                            */
/*==============================================================*/
create domain "DECIMAL" as DECIMAL;

/*==============================================================*/
/* Domain: ID                                                   */
/*==============================================================*/
create domain ID as NUMBER(10);

/*==============================================================*/
/* Domain: NUMBER_1_                                            */
/*==============================================================*/
create domain NUMBER_1_ as NUMERO(1);

/*==============================================================*/
/* Domain: OBSERVACAO                                           */
/*==============================================================*/
create domain OBSERVACAO as VARCHAR(2000);

/*==============================================================*/
/* Domain: TELEFONE                                             */
/*==============================================================*/
create domain TELEFONE as VARCHAR(16);

/*==============================================================*/
/* Domain: TEXTO_1_                                             */
/*==============================================================*/
create domain TEXTO_1_ as VARCHAR(1);

/*==============================================================*/
/* Domain: TEXTO_255_                                           */
/*==============================================================*/
create domain TEXTO_255_ as VARCHAR(255);

/*==============================================================*/
/* Domain: TEXTO_50_                                            */
/*==============================================================*/
create domain TEXTO_50_ as VARCHAR(50);

/*==============================================================*/
/* Table: ANIMAL                                                */
/*==============================================================*/
create table ANIMAL (
   ANI_ID               ID                   not null,
   UNI_ID               ID                   null,
   PES_ID               ID                   null,
   ANI_DESCRICAO        TEXTO_50_            null,
   ANI_NUMERO           TEXTO_50_            null,
   ANI_NASCIMENTO       DATE                 null,
   ANI_OBITO            DATE                 null,
   ANI_OBSERVACAO       TEXTO_255_           null,
   ANI_SEXO             TEXTO_1_             null,
   constraint PK_ANIMAL primary key (ANI_ID)
);

/*==============================================================*/
/* Table: OCORRENCIA                                            */
/*==============================================================*/
create table OCORRENCIA (
   SIT_ID               ID                   null,
   ANI_ID               ID                   null,
   VAC_ID               CHAR(10)             null,
   OCOT_ID              ID                   null,
   PES_VENDACLIENTE_ID  ID                   not null,
   OCO_VENDAVALOR       "DECIMAL"            null,
   OCO_DATA             DATE                 null,
   OCO_HORA             TEXTO_50_            null,
   OCO_OBSERVACAO       TEXTO_255_           null
);

/*==============================================================*/
/* Table: OCORRENCIATIPO                                        */
/*==============================================================*/
create table OCORRENCIATIPO (
   OCOT_ID              ID                   not null,
   OCOT_DESCRICAO       TEXTO_50_            null,
   constraint PK_OCORRENCIATIPO primary key (OCOT_ID)
);

/*==============================================================*/
/* Table: PARENTESCO                                            */
/*==============================================================*/
create table PARENTESCO (
   PAR_ID               ID                   not null,
   ANI_PAI_ID           ID                   null,
   ANI_MAE_ID           ID                   null,
   UNI_ID               ID                   null,
   constraint PK_PARENTESCO primary key (PAR_ID)
);

/*==============================================================*/
/* Table: PESSOA                                                */
/*==============================================================*/
create table PESSOA (
   PES_ID               ID                   not null,
   UNI_ID               ID                   null,
   PES_NOMERAZAO        TEXTO_50_            null,
   PES_APELIDOFANTASIA  TEXTO_50_            null,
   PES_TELEFONE1        TELEFONE             null,
   PES_TELEFONE2        TELEFONE             null,
   PES_LOGRADOURO       TEXTO_255_           null,
   PES_CPFCNPJ          VARCHAR(19)          null,
   PES_IE               TEXTO_255_           null,
   PES_RG               TEXTO_50_            null,
   PES_USUARIO          NUMBER_1_            null,
   PES_SENHA            TEXTO_50_            null,
   PES_EMAIL            TEXTO_50_            null,
   PES_PRINCIPAL        NUMBER_1_            null,
   CEP                  TEXTO_50_            null,
   constraint PK_PESSOA primary key (PES_ID)
);

/*==============================================================*/
/* Table: SITUACAO                                              */
/*==============================================================*/
create table SITUACAO (
   SIT_ID               ID                   not null,
   SIT_DESCRICAO        TEXTO_50_            null,
   constraint PK_SITUACAO primary key (SIT_ID)
);

comment on table SITUACAO is
'1 - PEDENTEN
2 - CONCLUIDO
3 - MORTO
4 - CANCELOU
5 - VENDIDO';

/*==============================================================*/
/* Table: UNIDADE                                               */
/*==============================================================*/
create table UNIDADE (
   UNI_ID               ID                   not null,
   UNI_DESCRICAO        TEXTO_50_            null,
   UNI_MARCA            OBSERVACAO           null,
   constraint PK_UNIDADE primary key (UNI_ID)
);

/*==============================================================*/
/* Table: VACINA                                                */
/*==============================================================*/
create table VACINA (
   VAC_ID               ID                   not null,
   VAC_DESCRICAO        TEXTO_50_            null,
   constraint PK_VACINA primary key (VAC_ID)
);

comment on table VACINA is
'1 - AFTOSA
2 - BRUCELOSA
3 - ...
4 - 2X1 XXX';

alter table ANIMAL
   add constraint FK_ANI_PES foreign key (PES_ID)
      references PESSOA (PES_ID)
      on delete restrict on update restrict;

alter table ANIMAL
   add constraint FK_ANI_UNI foreign key (UNI_ID)
      references UNIDADE (UNI_ID)
      on delete restrict on update restrict;

alter table OCORRENCIA
   add constraint FK_OCO_ANI foreign key (ANI_ID)
      references ANIMAL (ANI_ID)
      on delete restrict on update restrict;

alter table OCORRENCIA
   add constraint FK_OCO_OCOT foreign key (OCOT_ID)
      references OCORRENCIATIPO (OCOT_ID)
      on delete restrict on update restrict;

alter table OCORRENCIA
   add constraint FK_OCO_SIT foreign key (SIT_ID)
      references SITUACAO (SIT_ID)
      on delete restrict on update restrict;

alter table OCORRENCIA
   add constraint FK_OCO_VAC foreign key (VAC_ID)
      references VACINA (VAC_ID)
      on delete restrict on update restrict;

alter table PARENTESCO
   add constraint FK_PAR_ANI_MAE_ID foreign key (ANI_MAE_ID)
      references ANIMAL (ANI_ID)
      on delete restrict on update restrict;

alter table PARENTESCO
   add constraint FK_PAR_ANI_PAI_ID foreign key (ANI_PAI_ID)
      references ANIMAL (ANI_ID)
      on delete restrict on update restrict;

alter table PARENTESCO
   add constraint FK_PAR_UNI foreign key (UNI_ID)
      references UNIDADE (UNI_ID)
      on delete restrict on update restrict;

alter table PESSOA
   add constraint FK_PES_UNI foreign key (UNI_ID)
      references UNIDADE (UNI_ID)
      on delete restrict on update restrict;

