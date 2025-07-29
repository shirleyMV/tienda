<div style="text-align: center;">
    <a href="{{ asset($getState()) }}" target="_blank">
        <img src="{{ asset($getState()) }}" alt="QR" style="height: 50px;" />
    </a>
    <br>
    <button onclick="window.open('{{ asset($getState()) }}', '_blank').print();" style="font-size: 10px;">
        Imprimir
    </button>
</div>
