create table if not exists users
(
    id      bigint primary key not null,
    balance decimal(10, 2) default 0.0,
    constraint positive_balance check (balance >= 0)
);