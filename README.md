# ja-no-definitely
Interactive Development Term 4 assignment.

Follow these steps to get it running:
1. composer update
2. php bin/console doctrine:database:create
3. php bin/console doctrine:migration:migrate
2. php /bin/console server:start or run

Values for each table. Just run an INSERT INTO statement with the data:

user:
| id | email | username | name | surname
--- | --- | --- | --- | --- | ---
| 1 | asleigh@email.com | ashleighknowsbest | Ashleigh | Parsons
| 2 | andrea@email.com | andreaknowsbest | Andrea | Wilkins
| 3 | leo@email.com | leoknowsbest | Leo | Kuyper

question:
| id | category_id | question_text | question_upvotes | question_downvotes | question_author | question_date
--- | --- | --- | --- | --- | --- | --- | ---
| 1 | 7 | What are some of the best family beaches along the North Coast in KZN? |  |  | ashleighknowsbest | 2018-09-30 11:30:45
| 2 | 1 | At which nature reserves am I most likely to spot the Big Five? |  |  | andreaknowsbest | 2018-10-01 15:36:48
| 3 | 5 | Are there any venues where I can see some gumboot dancing? |  |  | leoknowsbest | 2018-10-03 08:12:22

answer:
| id | question_id | answer_text | answer_upvotes | answer_downvotes | answer_author | answer_date
--- | --- | --- | --- | --- | --- | --- | ---
| 1 | 1 | Salt Rock Beach is beautiful and family friendly! |  |  | andreaknowsbest | 2018-10-01 14:53:02
| 2 | 1 | Shakas Rock has lots of activities on the promenade. |  |  | leoknowsbest | 2018-10-03 19:00:19
| 3 | 2 | The Kruger National Park never disappoints! |  |  | leoknowsbest | 2018-10-01 22:03:17
| 4 | 2 | Dinokeng Game Reserve is a hidden gem. |  |  | ashleighknowsbest | 2018-10-04 06:47:32
| 5 | 3 | Gold Reef City occasionally has some on display - ask around for dates. |  |  | andreaknowsbest | 2018-10-04 23:55:03
| 6 | 3 | There are sometimes shows at the V& A Waterfront - keep an eye out! |  |  | ashleighknowsbest | 2018-10-05 13:50:26

category:
| id | category_name
--- | --- | ---
| 1 | Wildlife and Plants
| 2 | Geography and Climate
| 3 | Food and Shopping
| 4 | Adventure Experiences
| 5 | Cultural Experiences
| 6 | Big City Life
| 7 | Sun and Surf