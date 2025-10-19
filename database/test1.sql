select * from `categories` where exists (select `id` from `pages` inner join `page_categories` on `pages`.`id` = `page_categories`.`page_id` where `categories`.`id` = `page_categories`.`category_id` 
and `active` = 1 and `pages`.`deleted_at` is null) and `active` = 1 and `categories`.`deleted_at` is null order by RAND() limit 4


select * from `categories` where exists (select * from `pages` inner join `page_categories` on `pages`.`id` = `page_categories`.`page_id` where `categories`.`id` = `page_categories`.`category_id` 
and `active` = 1 and `pages`.`deleted_at` is null) and `active` = 1 and `categories`.`deleted_at` is null order by RAND() limit 4


select `pages`.*, `page_categories`.`category_id` as `pivot_category_id`, `page_categories`.`page_id` as `pivot_page_id` from `pages` 
inner join `page_categories` on `pages`.`id` = `page_categories`.`page_id` 
where `page_categories`.`category_id` = 17 and `active` = 1 and `pages`.`deleted_at` is null order by `id` desc limit 6

select `pages`.*, `page_categories`.`category_id` as `pivot_category_id`, `page_categories`.`page_id` as `pivot_page_id` from `pages` inner join `page_categories` on `pages`.`id` = `page_categories`.`page_id` where `page_categories`.`category_id` = 7 and `active` = 1 and `pages`.`deleted_at` is null order by `id` desc limit 6

select `type` from `page_contents` where `page_contents`.`deleted_at` is null
-- get type distinct:
select distinct `type` from `page_contents` where `page_contents`.`deleted_at` is null

-- select writer list for filter
select * from `writers` where exists (select * from `pages` where `writers`.`id` = `pages`.`writer` and `active` = 1 and `pages`.`deleted_at` is null) and `active` = 1 and `writers`.`deleted_at` is null

select `id`, `name` from `writers` where exists (select `id` from `pages` where `writers`.`id` = `pages`.`writer` and `active` = 1 and `pages`.`deleted_at` is null) and `active` = 1 and `writers`.`deleted_at` is null