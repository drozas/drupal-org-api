--Check if there are any dups (based on UIDs) due to problems with multiple executions
select mentored_uid, mentored_by_uid,mentored_username, mentored_by_username, count(*)
  from mentored_by
  group by mentored_uid,mentored_by_uid
  having count(*) > 1
