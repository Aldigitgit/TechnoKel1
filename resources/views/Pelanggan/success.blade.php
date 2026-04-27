<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pesanan Berhasil | Duha Pao</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --brown-dark: #4A1E0C;
            --brown: #6B3A2A;
            --brown-mid: #8B4A30;
            --gold: #D4882E;
            --gold-light: #E8A040;
            --cream: #FFF8F0;
            --cream-mid: #FFF2E5;
            --cream-dark: #FFE5CC;
            --muted: #9A7060;
            --text: #2C1A10;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, var(--cream) 0%, var(--cream-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }

        /* Decorative background */
        body::before {
            content: '🥟';
            position: fixed;
            bottom: 20px;
            left: 20px;
            font-size: 120px;
            opacity: 0.05;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '🥠';
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 100px;
            opacity: 0.05;
            pointer-events: none;
            z-index: 0;
        }

        .success-card {
            background: white;
            border-radius: 32px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            max-width: 550px;
            width: 100%;
            position: relative;
            z-index: 1;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .success-emoji {
            font-size: 80px;
            margin-bottom: 1rem;
            animation: bounce 1s ease infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .success-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--brown-dark);
            margin-bottom: 1rem;
        }

        .order-code {
            background: var(--cream-mid);
            padding: 0.75rem;
            border-radius: 12px;
            margin: 1rem 0;
            font-weight: 600;
            color: var(--brown);
        }

        .order-code span {
            color: var(--gold);
            font-size: 20px;
        }

        .whatsapp-info {
            background: linear-gradient(135deg, #25D36615, #25D36605);
            padding: 1rem;
            border-radius: 16px;
            margin: 1.5rem 0;
            border: 1px solid #25D36630;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 1.5rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            color: white;
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 136, 46, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 136, 46, 0.4);
            color: white;
        }

        .btn-secondary-custom {
            background: transparent;
            color: var(--brown);
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            border: 2px solid var(--brown);
            transition: all 0.3s ease;
        }

        .btn-secondary-custom:hover {
            background: var(--brown);
            color: white;
            transform: translateY(-2px);
        }

        .btn-wa {
            background: #25D366;
            color: white;
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-wa:hover {
            background: #1DA851;
            transform: translateY(-2px);
            color: white;
        }

        hr {
            margin: 1.5rem 0;
            border-color: rgba(212, 136, 46, 0.2);
        }

        @media (max-width: 480px) {
            .success-card {
                padding: 1.5rem;
            }
            .btn-group {
                flex-direction: column;
            }
            .btn-primary-custom, .btn-secondary-custom, .btn-wa {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-card">
            <div class="success-emoji">✅</div>
            <h2>pesanan Berhasil!</h2>
            <p style="color: var(--muted);">Terima kasih sudah memesan di Duha Pao.</p>
            
            <div class="order-code">
                <strong>Kode pesanan:</strong> <span>#{{ str_pad($pesanan->pesanan_id ?? '000', 6, '0', STR_PAD_LEFT) }}</span>
            </div>

            <div class="whatsapp-info">
                <strong>📱 Konfirmasi Cepat via WhatsApp</strong>
                <p style="font-size: 13px; margin-top: 8px; color: var(--muted);">
                    Kami akan segera menghubungi Anda. Atau klik tombol di bawah untuk chat langsung.
                </p>
                <a href="https://wa.me/6281234567890?text=Halo%20DuhaPao%20Cake%2C%20saya%20ingin%20konfirmasi%20pesanan%20%23{{ str_pad($pesanan->pesanan_id ?? '000', 6, '0', STR_PAD_LEFT) }}"
                   target="_blank"
                   class="btn-wa"
                   style="display: inline-flex;">
                    💬 Hubungi via WhatsApp
                </a>
            </div>

            <hr>

            <div class="btn-group">
                <a href="{{ route('home') }}" class="btn-primary-custom">
                    🏠 Kembali ke Beranda
                </a>
                <a href="{{ route('Pesan.create') }}" class="btn-secondary-custom">
                    🛒 pesan Lagi
                </a>
            </div>
        </div>
    </div>
</body>
</html>