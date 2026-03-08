@extends('layouts.app')
@section('title', 'Paiement - KEYZONE')
@section('content')
<div style="max-width: 800px; margin: 2rem auto; padding: 0 2rem;">
    <h1 style="text-align: center; font-size: 2.5rem; margin-bottom: 3rem; color: #a78bfa;"><i class="fas fa-credit-card"></i> Paiement Sécurisé</h1>

    <div style="background: rgba(30, 33, 52, 0.8); border-radius: 16px; padding: 3rem; border: 1px solid rgba(139, 92, 246, 0.2);">
        <!-- Order summary -->
        <div style="background: rgba(139, 92, 246, 0.1); border-radius: 12px; padding: 2rem; margin-bottom: 2rem; border: 1px solid rgba(139, 92, 246, 0.3);">
            <h3 style="margin-bottom: 1.5rem; color: #a78bfa;">Résumé de la commande</h3>
            @foreach($panier->lignes as $ligne)
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(139, 92, 246, 0.1);">
                    <span>{{ $ligne->produit->nom }} (x{{ $ligne->quantite }})</span>
                    <span>{{ number_format($ligne->sous_total, 2, ',', ' ') }} &euro;</span>
                </div>
            @endforeach
            <div id="promo-discount" style="display: none; justify-content: space-between; margin-bottom: 1rem; color: #34d399;">
                <span>Réduction code promo</span>
                <span id="discount-amount">-0,00 &euro;</span>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 1.5rem; font-weight: 700; color: #a78bfa; border-top: 2px solid rgba(139, 92, 246, 0.3); padding-top: 1rem; margin-top: 1rem;">
                <span>Total à payer</span>
                <span id="total-display">{{ number_format($total, 2, ',', ' ') }} &euro;</span>
            </div>
        </div>

        <!-- Promo Code -->
        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #c4b5fd;"><i class="fas fa-tag"></i> Code promo</label>
            <div style="display: flex; gap: 0.5rem;">
                <input type="text" id="promo-input" class="form-control" placeholder="Entrez votre code promo" style="flex: 1;">
                <button type="button" id="apply-promo" class="btn btn-primary" style="white-space: nowrap;">Appliquer</button>
            </div>
            <div id="promo-message" style="margin-top: 0.5rem; font-size: 0.9rem;"></div>
        </div>

        <form action="{{ route('paiement.payer') }}" method="POST">
            @csrf
            <button type="submit" style="width: 100%; padding: 1.5rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; border: none; border-radius: 8px; font-size: 1.3rem; font-weight: 700; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 30px rgba(16,185,129,0.4)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
                <i class="fas fa-lock"></i> Payer <span id="pay-amount">{{ number_format($total, 2, ',', ' ') }}</span> &euro;
            </button>
            <div style="text-align: center; margin-top: 2rem; color: #71717a;">
                <i class="fas fa-shield-alt" style="color: #10b981; margin-right: 0.5rem;"></i>
                Paiement 100% sécurisé par Stripe
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('apply-promo').addEventListener('click', function() {
    const code = document.getElementById('promo-input').value.trim();
    if (!code) return;

    fetch('{{ route("paiement.promo") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': window.csrfToken,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ code: code })
    })
    .then(r => r.json())
    .then(data => {
        const msg = document.getElementById('promo-message');
        if (data.success) {
            msg.style.color = '#34d399';
            msg.textContent = data.message + ' (-' + data.reduction + ' EUR)';
            document.getElementById('promo-discount').style.display = 'flex';
            document.getElementById('discount-amount').textContent = '-' + data.reduction + ' \u20AC';
            document.getElementById('total-display').textContent = data.total_reduit + ' \u20AC';
            document.getElementById('pay-amount').textContent = data.total_reduit;
        } else {
            msg.style.color = '#f87171';
            msg.textContent = data.message;
        }
    });
});
</script>
@endpush
