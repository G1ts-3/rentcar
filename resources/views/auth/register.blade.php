<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Rental Kendaraan</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #1e3a8a 75%, #172554 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite, pageLoad 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            position: relative;
            overflow: hidden;
            padding: 2rem 1rem;
            opacity: 0;
        }

        @keyframes pageLoad {
            0% { opacity: 0; transform: scale(0.98) translateY(-15px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Subtle grid background */
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 30px 30px;
            z-index: 1;
        }

        .register-container {
            display: flex;
            width: 1050px;
            max-width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
            position: relative;
            z-index: 10;
        }

        /* Left Panel - Branding */
        .brand-panel {
            flex: 1;
            background: linear-gradient(180deg, rgba(15,23,42,0.95) 0%, rgba(30,58,138,0.95) 100%);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .brand-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 50% 100%, rgba(59,130,246,0.15) 0%, transparent 70%);
        }

        .brand-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(59,130,246,0.5);
            position: relative;
            z-index: 2;
        }

        .brand-icon i { font-size: 2.2rem; color: white; }

        .brand-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            text-align: center;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
            letter-spacing: -0.5px;
        }

        .brand-subtitle {
            font-size: 0.95rem;
            color: #94a3b8;
            text-align: center;
            max-width: 280px;
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        /* Right Panel - Form */
        .form-panel {
            flex: 1.3;
            padding: 3rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .form-header h2 {
            font-size: 1.7rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 0.4rem;
            letter-spacing: -0.5px;
        }

        .form-header p {
            font-size: 0.95rem;
            color: #64748b;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .input-group-custom label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.4rem;
            display: block;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .input-wrapper input, .input-wrapper select {
            width: 100%;
            padding: 12px 16px 12px 46px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 500;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.2s ease;
            background: #f8fafc;
            color: #0f172a;
        }
        
        .input-wrapper input::placeholder { color: #94a3b8; font-weight: 400; }

        .input-wrapper select {
            appearance: none;
            cursor: pointer;
        }
        
        .select-arrow {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
            left: auto;
        }

        .input-wrapper input:focus, .input-wrapper select:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
        }

        .input-wrapper input:focus + i, .input-wrapper select:focus + i,
        .input-wrapper input:focus ~ i, .input-wrapper select:focus ~ i { color: #3b82f6; }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.2);
        }

        .btn-register:hover {
            background: #1e3a8a;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(30, 58, 138, 0.3);
        }

        .btn-register:active { transform: translateY(0); }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            gap: 16px;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            font-size: 0.8rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
        }

        .login-link {
            text-align: center;
            font-size: 0.95rem;
            color: #64748b;
            font-weight: 500;
        }

        .login-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s;
        }

        .login-link a:hover { color: #1d4ed8; text-decoration: underline; }

        .help-text {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.4rem;
            display: flex;
            align-items: center;
            gap: 4px;
            font-weight: 500;
        }

        .row-inputs {
            display: flex;
            gap: 20px;
        }
        .row-inputs .input-group-custom {
            flex: 1;
        }

        @media (max-width: 900px) {
            .brand-panel { display: none; }
            .register-container { max-width: 500px; }
            .row-inputs { flex-direction: column; gap: 0; }
            .form-panel { padding: 2.5rem 2rem; }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Left Branding Panel -->
        <div class="brand-panel">
            <div class="brand-icon" style="background: white;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; padding: 10px; border-radius: 20px;">
            </div>
            <h1 class="brand-title">Pendaftaran Akun</h1>
            <p class="brand-subtitle">Proses registrasi untuk mendapatkan hak akses ke sistem layanan rental kendaraan.</p>
        </div>

        <!-- Right Form Panel -->
        <div class="form-panel">
            <div class="form-header">
                <h2>Formulir Registrasi</h2>
                <p>Harap isi data sesuai dengan identitas diri Anda</p>
            </div>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                <div class="row-inputs">
                    <div class="input-group-custom">
                        <label>Nomor Induk Kependudukan (NIK)</label>
                        <div class="input-wrapper">
                            <input type="text" name="nik" placeholder="Contoh: 32010..." required>
                            <i class="fas fa-id-card"></i>
                        </div>
                    </div>
                    
                    <div class="input-group-custom">
                        <label>Nama Lengkap</label>
                        <div class="input-wrapper">
                            <input type="text" name="name" placeholder="Nama sesuai KTP" required>
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>

                <div class="row-inputs">
                    <div class="input-group-custom">
                        <label>Pilih Pekerjaan</label>
                        <div class="input-wrapper">
                            <select name="position" required>
                                <option value="" selected disabled>-- Pilih Pekerjaan --</option>
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                <option value="Wiraswasta">Wiraswasta</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <i class="fas fa-briefcase"></i>
                            <i class="fas fa-chevron-down select-arrow"></i>
                        </div>
                    </div>

                    <div class="input-group-custom">
                        <label>Nomor Kontak Aktif</label>
                        <div class="input-wrapper">
                            <input type="tel" name="number_phone" placeholder="0812..." required>
                            <i class="fas fa-phone"></i>
                        </div>
                    </div>
                </div>

                <div class="row-inputs">
                    <div class="input-group-custom">
                        <label>Username Sistem</label>
                        <div class="input-wrapper">
                            <input type="text" name="username" placeholder="ID login unik" required>
                            <i class="fas fa-at"></i>
                        </div>
                    </div>

                    <div class="input-group-custom">
                        <label>Password Akses</label>
                        <div class="input-wrapper">
                            <input type="password" name="password" placeholder="Buat sandi yang kuat" required>
                            <i class="fas fa-key"></i>
                        </div>
                        <div class="help-text"><i class="fas fa-shield-alt text-primary"></i> Minimal 6 karakter</div>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    Kirim Permintaan Registrasi
                    <i class="fas fa-paper-plane ml-1"></i>
                </button>
            </form>

            <div class="divider"><span>Otorisasi Tersedia</span></div>

            <div class="login-link">
                Telah terdaftar dalam sistem? <a href="{{ route('login') }}">Lanjutkan Login</a>
            </div>
        </div>
    </div>
</body>
</html>