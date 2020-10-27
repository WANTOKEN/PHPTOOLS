<?php
//        $map_order ['t1.create_time'] = array(array('EGT', $start_date." 00:00:00"), array('ELT', $end_date." 23:59:59"));
//        $map_order ['t1.status'] =  ['neq', 3];
//        $orderData = M("ReservationOrder")
//            ->alias('t1')
//            ->field('t1.reservation_id,t2.store_id,t1.create_time,t2.date')
//            ->join('cmf_reservation AS t2 ON t1.reservation_id = t2.id')
//            ->where($map_order)->select();

/**
select t1.reservation_id,t2.store_id,t1.create_time,t2.date from rzj_store.cmf_reservation_order t1
LEFT JOIN rzj_store.cmf_reservation t2 on
t1.reservation_id=t2.id where t1.create_time>='2020-06-28 00:00:00' and  t1.create_time<='2020-07-05 23:59:59' and t2.store_id='6033';

select * from rzj_store.cmf_reservation_order WHERE reservation_id='763985';
select * from rzj_store.cmf_reservation_order WHERE reservation_id='763995';
select * from rzj_store.cmf_verification WHERE reservation_id='763995';

select * from rzj_store.cmf_verification WHERE store_id='6096';
763995
select * from rzj_store.cmf_reservation_order WHERE reservation_id>='799371' and reservation_id<='799396';
select * from rzj_store.cmf_reservation_order WHERE reservation_id='799390' ;
select * from rzj_store.cmf_reservation WHERE id='799390' ;
 */