<template>
	<div class="dm-navigation">
		<div class="dm-navigation__inner">
			<router-link :to="{ name: 'table', query: { page: 'dm-admin-page', tab: 'table' } }">{{ $t('nav.tabTable') }}</router-link>
			<router-link :to="{ name: 'graph', query: { page: 'dm-admin-page', tab: 'graph' } }">{{ $t('nav.tabGraph') }}</router-link>
			<router-link :to="{ name: 'settings', query: { page: 'dm-admin-page', tab: 'settings' } }">{{ $t('nav.tabSetting')}}</router-link>
		</div>
	</div>
</template>

<script>
export default {
		name: 'Navigation'
	}
</script>