<template>
	<div class="settings-wrapper block-wrap">
		<div class="settings-wrapper__inner">
			<h1 class="common-heading">Graph - Without Plugin</h1>
			<LiveDataButton/>
			<GraphSvg :data="dmGraphData" />
		</div>
	</div>
	<div class="settings-wrapper block-wrap">
		<div class="settings-wrapper__inner graph-view">
			<h1 class="common-heading">Graph</h1>
			<LiveDataButton/>
			<ApexGraph :data="dmGraphData" />
		</div>
	</div>
</template>

<script>
	import GraphSvg from "../../Components/Graph/CustomGraph.vue";
	import ApexGraph from "../../Components/Graph/ApexGraph.vue";
	import {useStore} from "vuex";
	import {computed, onMounted} from "vue";
	import LiveDataButton from "../../Components/Graph/LiveDataButton.vue";

	export default {
		name: "Graph",
		components: {LiveDataButton, ApexGraph, GraphSvg},
		setup() {
			const store = useStore();
			// Execute load table data from the database when table mounting.
			onMounted(() => {
				store.dispatch('getGraphDataFromServer');
			});

			const dmGraphData = computed(() => {
				const rawData = store.getters.dmGraphData;
				const readable = store.getters.dmHumanDate;
				const data = rawData.map(point => ({
					x: readable ? new Date(point.x * 1000).toLocaleDateString() : point.x,
					y: point.y
				}));
				return [{ data }];
			});

			return {
				dmGraphData
			}

		}
}
</script>