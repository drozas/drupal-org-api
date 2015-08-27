-- Remove duplicates by using a tmp table

CREATE TABLE mentored_by_tmp AS SELECT DISTINCT * FROM mentored_by;
DELETE FROM mentored_by;
INSERT INTO mentored_by SELECT * FROM mentored_by_tmp;
DROP TABLE mentored_by_tmp;


--Add unique index removing any dups (based on UIDs) due to problems with multiple executions
--ALTER IGNORE TABLE mentored_by_temp ADD UNIQUE (mentored_uid,mentored_by_uid)

                                          

                                          
