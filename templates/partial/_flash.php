{% if flash_message is defined %}
    {% if flash_message.type == 'success' %}
        <div class="alert alert-success">{{ flash_message.message }}</div>
    {% elseif flash_message.type == 'fail' %}
        <div class="alert alert-danger">{{ flash_message.message }}</div>
    {% endif %}
{% endif %}
