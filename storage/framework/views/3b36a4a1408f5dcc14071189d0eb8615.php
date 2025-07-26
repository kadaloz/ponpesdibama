<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 

    
    <title><?php echo $__env->yieldContent('title', 'Pondok Pesantren Dibama - Pendidikan Islam Unggul'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Website resmi Pondok Pesantren Diniyah Baitul Makmur Aikmel, lembaga pendidikan Islam yang mencetak generasi Qur’ani dan berakhlak mulia.'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', 'pondok pesantren, dibama, pesantren aikmel, pendidikan islam, ppdb online, tahfidz, bahasa arab'); ?>">
    <meta name="author" content="Pondok Pesantren DIBAMA">

    
    <link rel="canonical" href="<?php echo e(url()->current()); ?>"/>

    
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', 'Pondok Pesantren Dibama - Pendidikan Islam Unggul'); ?>"/>
    <meta property="og:description" content="<?php echo $__env->yieldContent('meta_description'); ?>"/>
    
    <meta property="og:image" content="<?php echo $__env->yieldContent('meta_image', asset('storage/images/og-default.jpg')); ?>"/>
    <meta property="og:url" content="<?php echo e(url()->current()); ?>"/>
    <meta property="og:type" content="website"/>

    
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('title'); ?>"/>
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('meta_description'); ?>"/>
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('meta_image', asset('storage/images/og-default.jpg')); ?>"/>

    
    
    <link rel="icon" href="<?php echo e(asset('storage/images/logo/dibama.ico')); ?>" sizes="32x32">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo e(asset('storage/images/logo/dibama.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('storage/images/logo/dibama.png')); ?>">


<script type="application/ld+json">
<?php echo json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'EducationalOrganization',
            'name' => 'Pondok Pesantren Diniyah Baitul Makmur Aikmel',
            'url' => url('/'),
            'logo' => asset('storage/images/logo/dibama.png'),
            'description' => 'Website resmi Pondok Pesantren DIBAMA Aikmel, lembaga pendidikan Islam unggul membina generasi Qur\'ani dan berakhlak mulia.',
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+6281916577540',
                'contactType' => 'Customer Support',
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. Raya Aikmel - Terara, Kec. Aikmel, Kab. Lombok Timur',
                'addressLocality' => 'Aikmel',
                'addressRegion' => 'Nusa Tenggara Barat',
                'postalCode' => '83653',
                'addressCountry' => 'ID',
            ],
            'hasMap' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.7410000000005!2d116.480000!3d-8.625000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z4bm84bm84bm84bm8!5e0!3m2!1sid!2sid!4v1678888888888!5m2!1sid!2sid'
        ],
        [
            '@type' => 'WebSite',
            'name' => 'Official Website of Ponpes DIBAMA',
            'url' => url('/'),
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>

</script>





    
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    
    

    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            scroll-behavior: smooth; /* Enables smooth scrolling for #links */
        }

        /* Custom styles for section titles */
        .section-title {
            @apply text-4xl md:text-5xl lg:text-6xl font-extrabold text-center mb-12
                   bg-clip-text text-transparent bg-gradient-to-r from-teal-700 to-blue-700
                   drop-shadow-xl;
        }

        /* Apply rounded corners and shadow to all images by default */
        img {
            @apply rounded-lg shadow-md;
        }

        /* Basic animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-fade-in-down { animation: fadeInDown 1s ease-out forwards; }
        .animate-fade-in-up { animation: fadeInUp 1s ease-out forwards 0.5s; }
        /* Note: The WhatsApp button directly applies animate-bounce */

        /* Modal specific styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border-radius: 0.5rem;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: relative;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer; /* Added for better UX */
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
        }

        /* Adds scroll-margin-top to all sections with an ID, useful for sticky headers */
        section[id] {
            scroll-margin-top: 150px; /* Adjust this value if your sticky header height changes */
        }

        /* Alpine.js x-cloak: Hides elements until Alpine.js is initialized */
        [x-cloak] {
            display: none !important;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?> 
    <?php echo $__env->yieldPushContent('head'); ?> 
</head>
<body class="bg-gray-50 text-gray-800">

    
    
    <?php echo $__env->make('web.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main>
        <?php echo $__env->yieldContent('main_content'); ?> 
    </main>

    
    
    <?php echo $__env->make('web.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    
    <?php echo $__env->make('web.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->yieldPushContent('scripts'); ?>


</body>
</html><?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/web/apps.blade.php ENDPATH**/ ?>