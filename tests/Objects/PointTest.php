<?php
/**
 * Copyright (c) 2017. Tomasz Konarski.
 */

namespace T3ko\Inpost\Test\Objects;

use T3ko\Inpost\Objects\Address;
use T3ko\Inpost\Objects\PaymentType;
use T3ko\Inpost\Objects\PointFunction;
use T3ko\Inpost\Objects\PointService;
use T3ko\Inpost\Objects\PointStatus;
use T3ko\Inpost\Objects\PointType;

class PointTest extends \PHPUnit_Framework_TestCase
{
    public function testItDeserializesFromCompleteData1()
    {
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        $json = '{"href":"http://api-pl-points.easypack24.net/v1/points/AUG300","name":"AUG300","type":["parcel_locker' .
            '"],"status":"Operating","services":["parcel_dropoff","parcel_pickup","allegro_parcel_dropoff","allegro_p' .
            'arcel_pickup"],"location":{"latitude":53.83737,"longitude":22.98884},"location_type":null,"location_desc' .
            'ription":"Przy markecie POLOmarket","location_description_1":null,"location_description_2":"POLOmarket",' .
            '"opening_hours":"24/7","address":{"line1":"Sucharskiego 1","line2":"16-300 Augustów"},"address_details":' .
            '{"city":"Augustów","province":"podlaskie","post_code":"16-300","street":"Sucharskiego","building_number"' .
            ':"1","flat_number":null},"phone_number":null,"payment_point_descr":"Płatność internetowa PayByLink. Dost' .
            'ępność 24/7","functions":["parcel","parcel_collect","standard_courier_send","allegro_courier_collect","a' .
            'llegro_parcel_send","parcel_send","allegro_courier_reverse_return_send","allegro_parcel_reverse_return_s' .
            'end","allegro_letter_send","allegro_courier_send","parcel_reverse_return_send","allegro_parcel_collect",' .
            '"standard_courier_reverse_return_send"],"partner_id":0,"is_next":false,"payment_available":false,"paymen' .
            't_type":{"0":"Brak obsługi płatności"}}';

        $point = $serializer->deserialize($json, 'T3ko\Inpost\Objects\Point', 'json');
        $this->assertInstanceOf('T3ko\Inpost\Objects\Point', $point);

        $this->assertSame('AUG300', $point->getName());
        $this->assertContains(PointType::PARCEL_LOCKER, $point->getTypes());
        $this->assertCount(1, $point->getTypes());
        $this->assertSame(PointStatus::OPERATING, $point->getStatus());
        $this->assertContains(PointService::PARCEL_DROPOFF, $point->getServices());
        $this->assertContains(PointService::PARCEL_PICKUP, $point->getServices());
        $this->assertContains(PointService::ALLEGRO_PARCEL_DROPOFF, $point->getServices());
        $this->assertContains(PointService::ALLEGRO_PARCEL_PICKUP, $point->getServices());
        $this->assertCount(4, $point->getServices());
        $this->assertSame(53.83737, $point->getLocationLatitude());
        $this->assertSame(22.98884, $point->getLocationLongitude());
        $this->assertNull($point->getLocationType());
        $this->assertSame('Przy markecie POLOmarket', $point->getLocationDescription());
        $this->assertNull($point->getLocationDescription1());
        $this->assertSame('POLOmarket', $point->getLocationDescription2());
        $this->assertSame('24/7', $point->getOpeningHours());
        $this->assertSame('Sucharskiego 1', $point->getAddressLine1());
        $this->assertSame('16-300 Augustów', $point->getAddressLine2());

        $address = new Address(null, 'Sucharskiego', '1', null, '16-300', 'Augustów', 'podlaskie');
        $this->assertEquals($address, $point->getAddressDetails());
        $this->assertNull($point->getPhoneNumber());
        $this->assertSame('Płatność internetowa PayByLink. Dostępność 24/7', $point->getPaymentPointDescription());
        $this->assertContains(PointFunction::PARCEL, $point->getFunctions());
        $this->assertContains(PointFunction::PARCEL_COLLECT, $point->getFunctions());
        $this->assertContains(PointFunction::STANDARD_COURIER_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_COURIER_COLLECT, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_PARCEL_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::PARCEL_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_COURIER_REVERSE_RETURN_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_PARCEL_REVERSE_RETURN_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_LETTER_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_COURIER_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::PARCEL_REVERSE_RETURN_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_PARCEL_COLLECT, $point->getFunctions());
        $this->assertContains(PointFunction::STANDARD_COURIER_REVERSE_RETURN_SEND, $point->getFunctions());
        $this->assertCount(13, $point->getFunctions());
        $this->assertSame(0, $point->getPartnerId());
        $this->assertFalse($point->isNext());
        $this->assertFalse($point->isPaymentAvailable());
        $this->assertSame(PaymentType::NONE, $point->getPaymentType());
    }

    public function testItDeserializesFromCompleteData2()
    {
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        $json = '{"href":"http://api-pl-points.easypack24.net/v1/points/WAW07AP","name":"WAW07AP","type":["laundry_lo' .
            'cker","parcel_locker"],"status":"Operating","services":["laundry_dropoff","laundry_pickup","parcel_dropo' .
            'ff","parcel_pickup","allegro_parcel_dropoff","allegro_parcel_pickup"],"location":{"latitude":52.24948,"l' .
            'ongitude":20.98633},"location_type":null,"location_description":"Na osiedlu mieszkaniowym","location_des' .
            'cription_1":null,"location_description_2":null,"opening_hours":null,"address":{"line1":"Jana Pawła II 65' .
            '","line2":"01-038 Warszawa"},"address_details":{"city":"Warszawa","province":"mazowieckie","post_code":"' .
            '01-038","street":"Jana Pawła II","building_number":"65","flat_number":null},"phone_number":null,"payment' .
            '_point_descr":null,"functions":["parcel","parcel_collect","standard_courier_send","allegro_courier_colle' .
            'ct","allegro_parcel_send","parcel_send","allegro_courier_reverse_return_send","allegro_parcel_reverse_re' .
            'turn_send","allegro_letter_send","allegro_courier_send","parcel_reverse_return_send","laundry","allegro_' .
            'parcel_collect","standard_courier_reverse_return_send"],"partner_id":0,"is_next":false,"payment_availabl' .
            'e":true,"payment_type":{"2":"Płatność kartą w Paczkomacie"}}';

        $point = $serializer->deserialize($json, 'T3ko\Inpost\Objects\Point', 'json');
        $this->assertInstanceOf('T3ko\Inpost\Objects\Point', $point);

        $this->assertSame('WAW07AP', $point->getName());
        $this->assertContains(PointType::PARCEL_LOCKER, $point->getTypes());
        $this->assertContains(PointType::LAUNDRY_LOCKER, $point->getTypes());
        $this->assertCount(2, $point->getTypes());
        $this->assertSame(PointStatus::OPERATING, $point->getStatus());
        $this->assertContains(PointService::PARCEL_DROPOFF, $point->getServices());
        $this->assertContains(PointService::PARCEL_PICKUP, $point->getServices());
        $this->assertContains(PointService::ALLEGRO_PARCEL_DROPOFF, $point->getServices());
        $this->assertContains(PointService::ALLEGRO_PARCEL_PICKUP, $point->getServices());
        $this->assertContains(PointService::LAUNDRY_DROPOFF, $point->getServices());
        $this->assertContains(PointService::LAUNDRY_PICKUP, $point->getServices());
        $this->assertCount(6, $point->getServices());
        $this->assertSame(52.24948, $point->getLocationLatitude());
        $this->assertSame(20.98633, $point->getLocationLongitude());
        $this->assertNull($point->getLocationType());
        $this->assertSame('Na osiedlu mieszkaniowym', $point->getLocationDescription());
        $this->assertNull($point->getLocationDescription1());
        $this->assertNull($point->getLocationDescription2());
        $this->assertNull($point->getOpeningHours());
        $this->assertSame('Jana Pawła II 65', $point->getAddressLine1());
        $this->assertSame('01-038 Warszawa', $point->getAddressLine2());

        $address = new Address(null, 'Jana Pawła II', '65', null, '01-038', 'Warszawa', 'mazowieckie');
        $this->assertEquals($address, $point->getAddressDetails());
        $this->assertNull($point->getPhoneNumber());
        $this->assertNull($point->getPaymentPointDescription());
        $this->assertContains(PointFunction::PARCEL, $point->getFunctions());
        $this->assertContains(PointFunction::PARCEL_COLLECT, $point->getFunctions());
        $this->assertContains(PointFunction::STANDARD_COURIER_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_COURIER_COLLECT, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_PARCEL_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::PARCEL_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_COURIER_REVERSE_RETURN_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_PARCEL_REVERSE_RETURN_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_LETTER_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_COURIER_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::PARCEL_REVERSE_RETURN_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_PARCEL_COLLECT, $point->getFunctions());
        $this->assertContains(PointFunction::STANDARD_COURIER_REVERSE_RETURN_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::LAUNDRY, $point->getFunctions());
        $this->assertCount(14, $point->getFunctions());
        $this->assertSame(0, $point->getPartnerId());
        $this->assertFalse($point->isNext());
        $this->assertTrue($point->isPaymentAvailable());
        $this->assertSame(PaymentType::CARD, $point->getPaymentType());
    }

    public function testItDeserializesFromCompleteData3()
    {
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        $json = '{"href":"http://api-pl-points.easypack24.net/v1/points/MALPKA2032","name":"MALPKA2032","type":["pok"' .
            ',"pop"],"status":"Operating","services":["parcel_pickup","allegro_parcel_dropoff","allegro_letter_dropof' .
            'f"],"location":{"latitude":54.38944,"longitude":19.83444},"location_type":null,"location_description":"S' .
            'KLEP MAŁPKA EXPRESS ","location_description_1":"Punkt","location_description_2":null,"opening_hours":"PN' .
            '-PT 07:00-00:00 SB 07:00-00:00 ND 07:00-00:00","address":{"line1":"Królewiecka 60B","line2":"14-500 Bran' .
            'iewo"},"address_details":{"city":"Braniewo","province":"warmińsko-mazurskie","post_code":"14-500","stree' .
            't":"Królewiecka","building_number":"60B","flat_number":null},"phone_number":null,"payment_point_descr":"' .
            'Płatność wyłącznie za pomocą PayByLink","functions":["allegro_parcel_send","allegro_courier_send","parce' .
            'l_send","allegro_letter_send","standard_letter_send","standard_courier_send"],"partner_id":12,"is_next":' .
            'false,"payment_available":false,"payment_type":{"0":"Brak obsługi płatności"}}';

        $point = $serializer->deserialize($json, 'T3ko\Inpost\Objects\Point', 'json');
        $this->assertInstanceOf('T3ko\Inpost\Objects\Point', $point);

        $this->assertSame('MALPKA2032', $point->getName());
        $this->assertContains(PointType::POK, $point->getTypes());
        $this->assertContains(PointType::POP, $point->getTypes());
        $this->assertCount(2, $point->getTypes());
        $this->assertSame(PointStatus::OPERATING, $point->getStatus());
        $this->assertContains(PointService::PARCEL_PICKUP, $point->getServices());
        $this->assertContains(PointService::ALLEGRO_PARCEL_DROPOFF, $point->getServices());
        $this->assertContains(PointService::ALLEGRO_LETTER_DROPOFF, $point->getServices());
        $this->assertCount(3, $point->getServices());
        $this->assertSame(54.38944, $point->getLocationLatitude());
        $this->assertSame(19.83444, $point->getLocationLongitude());
        $this->assertNull($point->getLocationType());
        $this->assertSame('SKLEP MAŁPKA EXPRESS ', $point->getLocationDescription());
        $this->assertSame('Punkt', $point->getLocationDescription1());
        $this->assertNull($point->getLocationDescription2());
        $this->assertSame('PN-PT 07:00-00:00 SB 07:00-00:00 ND 07:00-00:00', $point->getOpeningHours());
        $this->assertSame('Królewiecka 60B', $point->getAddressLine1());
        $this->assertSame('14-500 Braniewo', $point->getAddressLine2());

        $address = new Address(null, 'Królewiecka', '60B', null, '14-500', 'Braniewo', 'warmińsko-mazurskie');
        $this->assertEquals($address, $point->getAddressDetails());
        $this->assertNull($point->getPhoneNumber());
        $this->assertSame('Płatność wyłącznie za pomocą PayByLink', $point->getPaymentPointDescription());
        $this->assertContains(PointFunction::ALLEGRO_PARCEL_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_COURIER_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::PARCEL_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::ALLEGRO_LETTER_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::STANDARD_LETTER_SEND, $point->getFunctions());
        $this->assertContains(PointFunction::STANDARD_COURIER_SEND, $point->getFunctions());
        $this->assertCount(6, $point->getFunctions());
        $this->assertSame(12, $point->getPartnerId());
        $this->assertFalse($point->isNext());
        $this->assertFalse($point->isPaymentAvailable());
        $this->assertSame(PaymentType::NONE, $point->getPaymentType());
    }
}
