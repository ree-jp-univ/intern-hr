<style>
    .welcome {
        margin: 0;
        text-align: center;
    }
</style>
<script src='https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.min.js'></script>

<div>
    <h1 class='welcome'><?php echo $username; ?>さん､ようこそ</h1>
    <div class='content' data-bind='text: message'></div>
    <script src='/assets/js/home.js'></script>
</div>