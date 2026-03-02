<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Headless WordPress</title>
    <?php wp_head(); ?>
    <style>
        html {
            height: 100%;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            min-height: 100vh;
            height: 100%;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        /* WordPress admin bar adjustment */
        body.admin-bar {
            padding-top: 0 !important;
        }

        .headless-notice {
            max-width: 500px;
            margin: 20px;
            padding: 40px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .headless-notice img.logo {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
        }

        .headless-notice h1 {
            color: #333;
            margin: 0 0 15px 0;
            font-size: 28px;
        }

        .headless-notice p {
            color: #666;
            line-height: 1.8;
            margin: 0 0 20px 0;
        }

        .version {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="headless-notice">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/sw-headless.png" alt="Headless WordPress" class="logo">
        <h1>Headless WordPress</h1>
        <p>
            This WordPress installation is running in <strong>headless mode</strong>.<br>
            All frontend rendering is handled by your chosen framework.
        </p>
        <div class="version">
            <strong>SW Headless Theme</strong> v1.0.0
        </div>
    </div>
    <?php wp_footer(); ?>
</body>

</html>
