<!DOCTYPE html>
<html lang="en">
{% include 'head.twig'%}
<body>
{% include 'nav.twig' %}
<div class="container">
    <h2>Список заказов</h2>
    <div class="form-order">
        {% include 'fileForm.twig'%}

    </div>
    {% include 'photoList.twig' %}
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../../public/js/main.js"></script>
<script src="../../../public/js/bootstrap.min.js"></script>
</body>
</html>
