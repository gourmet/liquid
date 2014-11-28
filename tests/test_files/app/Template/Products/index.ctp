{% if products %}
	<ul id="products">
	{% for product in products %}
		<li>
			<h2>{{ product.name | capitalize }}</h2>
			Only ${{ product.price }}

			{{ product.description | truncate: 100, '...' }}

		</li>
	{% endfor %}
	</ul>
{% endif %}
