<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement annulé - KEYZONE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0a0a0f 0%, #1e1d2d 100%);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cancel-container {
            text-align: center;
            padding: 4rem;
            background: rgba(30, 33, 52, 0.8);
            border-radius: 16px;
            border: 2px solid #ef4444;
            max-width: 600px;
            margin: 2rem;
        }

        .cancel-icon {
            font-size: 6rem;
            color: #ef4444;
            margin-bottom: 2rem;
        }

        h1 {
            color: #ef4444;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }

        p {
            color: #a1a1aa;
            margin-bottom: 2rem;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .btn {
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            display: inline-block;
            margin: 0.5rem;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>
    <div class="cancel-container">
        <div class="cancel-icon">
            <i class="fas fa-times-circle"></i>
        </div>
        <h1>Paiement annulé</h1>
        <p>Le paiement a été annulé. Votre panier est toujours disponible.</p>
        <div>
            <a href="{{ route('panier.index') }}" class="btn">Retour au panier</a>
            <a href="{{ route('home') }}" class="btn btn-secondary">Accueil</a>
        </div>
    </div>
</body>
</html>