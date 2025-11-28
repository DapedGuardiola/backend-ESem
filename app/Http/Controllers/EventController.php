<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function showBooking($eventId)
    {
        // Data dummy events - in real application, this would come from database
        $events = [
            1 => [
                'id' => 1,
                'title' => 'Seminar About Musical - Sunday',
                'speaker' => 'A.R. Rahman',
                'date' => 'Aug 13',
                'time' => 'Sun • 10:00am',
                'location' => 'Sawojajar, Kota Malang',
                'price' => 'Rp 50.000',
                'type' => 'seminar',
                'image' => '/image/image1.png',
                'description' => 'Seminar ini akan membahas sejarah, perkembangan, dan teknik dasar pementasan musikal Broadway dan lokal. Cocok untuk calon artis, seniman, dan penggemar teater. Pembahasan meliputi: Seni Vokal Musikal, Koreografi Panggung, dan Penyutradaraan Kreatif.'
            ],
            2 => [
                'id' => 2,
                'title' => 'Personality Seminar',
                'speaker' => 'Dr. Maya Sari, M.Psi',
                'date' => 'Aug 13',
                'time' => 'Sun • 11:00am',
                'location' => 'Ayani, Kota Surabaya',
                'price' => 'Gratis',
                'type' => 'seminar',
                'image' => '/image/image2.png',
                'description' => 'Workshop intensif 4 jam untuk mengasah keterampilan komunikasi non-verbal dan membangun kepercayaan diri (self-confidence) di lingkungan profesional. Dapatkan tips praktis untuk wawancara kerja, negosiasi, dan presentasi publik yang efektif.'
            ],
            3 => [
                'id' => 3,
                'title' => 'Seminar Kerohanian',
                'speaker' => 'Ustadz Hanan Attaki',
                'date' => 'Aug 13',
                'time' => 'Sun • 11:00am',
                'location' => 'Sukun, Kota Malang',
                'price' => 'Donasi Sukarela',
                'type' => 'seminar',
                'image' => '/image/image3.png',
                'description' => 'Sebuah sesi tausiyah yang menenangkan hati, membahas pentingnya keseimbangan spiritual di tengah kesibukan duniawi. Tema kali ini: "Mencari Ketenangan di Tengah Badai Kehidupan". Terbuka untuk umum.'
            ]
        ];

        if (!isset($events[$eventId])) {
            abort(404, 'Event not found');
        }

        return view('homepage', [
            'isBookingPage' => true,
            'eventData' => $events[$eventId]
        ]);
    }
}