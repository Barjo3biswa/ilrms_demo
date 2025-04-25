alter table petition_basic add column assign_ast_code varchar(10)
# production

ALTER TABLE petition_proceeding ALTER COLUMN user_code TYPE VARCHAR(10);
#check in production and demo

ALTER TABLE reclass_suite_basic  
ADD COLUMN bhumiputra_certificate_no VARCHAR(10);
#demo

alter table settlement_basic add column dept_revert integer default 0;
alter table reclass_suite_basic add column dept_revert integer default 0;
alter table reclass_suite_basic add column add_off_desig varchar(5);


alter table petition_basic add column dept_revert integer default 0;
alter table petition_basic add column add_off_desig varchar(5);

application\controllers\DeptTenant.php->getSelfDocApi:371