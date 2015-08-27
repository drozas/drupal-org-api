--Script to create a list of unique nodes
(SELECT DISTINCT t1.mentored_uid, t1.mentored_username FROM `mentored_by` t1)
UNION
(SELECT DISTINCT t2.mentored_by_uid, t2.mentored_by_username FROM `mentored_by` t2)
