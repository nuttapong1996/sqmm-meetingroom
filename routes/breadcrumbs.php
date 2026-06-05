<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Facades\Auth;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('หน้าหลัก', route('home'));
});

Breadcrumbs::for('room.status' ,function(BreadcrumbTrail $trail , $id ,$room_name){
    $trail->parent('home');
    $trail->push('สถานะห้องประชุม: '.$room_name , route('room.status', $id));
});

Breadcrumbs::for('personal.events', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('รายการจองของฉัน', route('personal.events'));
});

Breadcrumbs::for('meeting.create', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('จองห้องประชุม', route('meeting.create'));
});

Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('แดชบอร์ดผู้ดูแล', route('admin'));
});

Breadcrumbs::for('room.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('ห้องประชุมทั้งหมด', route('room.index'));
});

Breadcrumbs::for('room.create', function (BreadcrumbTrail $trail) {
    $trail->parent('room.index');
    $trail->push('เพิ่มห้องประชุม', route('room.create'));
});

Breadcrumbs::for('room.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('room.index');
    $trail->push('แก้ไขห้องประชุม', route('room.edit', $id));
});

Breadcrumbs::for('meeting.show', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('personal.events');
    $trail->push('รายละเอียดการประชุม', route('meeting.show', $id));
});

Breadcrumbs::for('admin.meeting.list', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('รายการจองทั้งหมด', route('admin.meeting.list'));
});

Breadcrumbs::for('admin.meeting.show', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('admin.meeting.list');
    $trail->push('รายละเอียดการประชุม', route('admin.meeting.show', $id));
});

Breadcrumbs::for('zoom.list', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('รายการร้องขอ Zoom', route('zoom.list'));
});

Breadcrumbs::for('admin.zoom.create', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('zoom.list');
    $trail->push('สร้าง Link Zoom', route('admin.zoom.create', $id));
});



// // Home > Blog
// Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });
