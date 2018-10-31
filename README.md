# ja-no-definitely
Interactive Development Term 4 assignment.

Follow these steps to get it running:
1. composer update
2. php bin/console doctrine:database:create
3. php bin/console doctrine:migration:migrate
4. 

INSERT INTO "public"."user_account"(id, email, username, name, surname, image_path, type, password ) VALUES (1, 'ashleigh@email.com', 'ashleighknowsbest', 'Ashleigh', 'Parsons', 'default_img.jpg', 'admin', 'alaska');
INSERT INTO "public"."user_account"(id, email, username, name, surname, image_path, type, password ) VALUES (2, 'andrea@email.com', 'andreaknowsbest', 'Andrea', 'Wilkins', 'default_img.jpg', 'admin','togo');
INSERT INTO "public"."user_account"(id, email, username, name, surname, image_path, type, password ) VALUES (3, 'leo@email.com', 'leoknowsbest', 'Leo', 'Kuyper', 'default_img.jpg', 'admin', 'max');

//Timestamp does not want to insert correctly....

INSERT INTO "public"."question"(id, category_id, question_text, question_upvotes, question_downvotes, question_author, question_date, author_id ) VALUES (1, 7, 'What are some of the best family beaches along the North Coast in KZN?', 0, 0, 'ashleighknowsbest', '2018-09-30', 1); 
INSERT INTO "public"."question"(id, category_id, question_text, question_upvotes, question_downvotes, question_author, question_date, author_id ) VALUES (2, 1, 'At which nature reserves am I most likely to spot the Big Five?', 0, 0, 'andreaknowsbest', '2018-10-01', 2);
INSERT INTO "public"."question"(id, category_id, question_text, question_upvotes, question_downvotes, question_author, question_date, author_id ) VALUES (3, 1, 'Are there any venues where I can see some gumboot dancing?', 0, 0, 'leoknowsbest', '2018-10-03', 3);

INSERT INTO "public"."answer"(id, question_id, answer_text, answer_upvotes, answer_downvotes, answer_author, answer_date, author_id ) VALUES (1, 1, 'Salt Rock Beach is beautiful and family friendly!', 0, 0, 'andreaknowsbest', '2018-10-01', 2);
INSERT INTO "public"."answer"(id, question_id, answer_text, answer_upvotes, answer_downvotes, answer_author, answer_date, author_id ) VALUES (2, 1, 'Shakas Rock has lots of activities on the promenade.', 0, 0, 'leoknowsbest', '2018-10-03', 3);
INSERT INTO "public"."answer"(id, question_id, answer_text, answer_upvotes, answer_downvotes, answer_author, answer_date, author_id ) VALUES (3, 2, 'The Kruger National Park never disappoints!', 0, 0, 'leoknowsbest', '2018-10-01', 3);
INSERT INTO "public"."answer"(id, question_id, answer_text, answer_upvotes, answer_downvotes, answer_author, answer_date, author_id ) VALUES (4, 2, 'Dinokeng Game Reserve is a hidden gem.', 0, 0, 'ashleighknowsbest', '2018-10-04', 1);
INSERT INTO "public"."answer"(id, question_id, answer_text, answer_upvotes, answer_downvotes, answer_author, answer_date, author_id ) VALUES (5, 3, 'Gold Reef City occasionally has some on display - ask around for dates.', 0, 0, 'andreaknowsbest', '2018-10-04', 2);
INSERT INTO "public"."answer"(id, question_id, answer_text, answer_upvotes, answer_downvotes, answer_author, answer_date, author_id ) VALUES (6, 3, 'There are sometimes shows at the V& A Waterfront - keep an eye out!', 0, 0, 'ashleighknowsbest', '2018-10-05', 1);

INSERT INTO "public"."category"(id, category_name) VALUES (1, 'Wildlife and Plants');
INSERT INTO "public"."category"(id, category_name) VALUES (2, 'Geography and Climate');
INSERT INTO "public"."category"(id, category_name) VALUES (3, 'Food and Shopping');
INSERT INTO "public"."category"(id, category_name) VALUES (4, 'Adventure Experiences');
INSERT INTO "public"."category"(id, category_name) VALUES (5, 'Cultural Experiences');
INSERT INTO "public"."category"(id, category_name) VALUES (6, 'Big City Life');
INSERT INTO "public"."category"(id, category_name) VALUES (7, 'Sun and Surf');


5. php /bin/console server:start or run