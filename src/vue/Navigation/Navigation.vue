<template>
	<div class="dm-navigation">
		<div class="dm-navigation__inner">
			<router-link :to="{ name: 'table', query: { page: 'dm-admin-page', tab: 'table' } }">Table</router-link>
			<router-link :to="{ name: 'graph', query: { page: 'dm-admin-page', tab: 'graph' } }">Graph</router-link>
			<router-link :to="{ name: 'settings', query: { page: 'dm-admin-page', tab: 'settings' } }">Settings</router-link>
		</div>
	</div>
</template>

<script>
export default {
		name: 'Navigation'
	}
</script>