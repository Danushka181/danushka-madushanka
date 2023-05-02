<template>
	<div class="settings-wrapper block-wrap">
		<div class="settings-wrapper__inner">
			<h1 class="common-heading">Settings</h1>

			<div class="setting-area">
				<EmailSettings />
				<RowAndDateFormat />
			</div>

		</div>
	</div>
</template>

<script>
import EmailSettings from '../../Components/Setting/EmailSettings.vue';
import RowAndDateFormat from '../../Components/Setting/RowAndDateFormat.vue';

export default {
	name: "Settings",
	components: {
		EmailSettings,
		RowAndDateFormat
	}
}
</script>