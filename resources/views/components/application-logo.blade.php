<div class="image-container">
    <img src="{{ asset('icon.png') }}" {{ $attributes }} alt="eBISU.pay">
</div>

<style>
.image-container {
    display: inline-block;
    position: relative;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 1); /* Sombreado */
    transition: transform 0.2s ease-in-out; /* Animación de flotación */
    border-radius: 20%;
}

.image-container:hover {
    transform: translateY(-5px); /* Desplazar hacia arriba en hover */
}

.image-container img {
    display: block;
    max-width: 100%;
    height: auto;
}
</style>