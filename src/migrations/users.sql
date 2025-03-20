create table if not exists users
(
    id      serial primary key,
    username text not null unique,
    balance decimal(10, 2) default 0.0,
    constraint positive_balance check (balance >= 0)
);