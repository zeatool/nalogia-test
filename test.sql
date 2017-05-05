SELECT t.storage_id,t.category_id,t.quantity
  FROM incoming t
  INNER JOIN
    (
      SELECT MAX(time) as time,storage_id,category_id
        FROM incoming
        GROUP BY storage_id,category_id
    ) t1
    ON t.storage_id=t1.storage_id AND t.category_id=t1.category_id AND t.time = t1.time
ORDER BY t.storage_id,t.category_id       
