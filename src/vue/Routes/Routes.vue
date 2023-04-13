<script>
	import { createRouter, createWebHistory } from "vue-router";
	import Graph from "../Admin/Tabs/Graph.vue";
	import Table from "../Admin/Tabs/Table.vue";
	import Settings from "../Admin/Tabs/Settings.vue";
	
	import Navigation from "../Navigation/Navigation.vue";

	const routes = [
		{
			path: "/wp-admin/admin.php",
			name: "table",
			props: (route) => ({
				page: route.query.page,
				tab: route.query.tab || "table"
			}),
			components: { default: Table, tab: Navigation },
		},
		{
			path: "/wp-admin/admin.php",
			name: "graph",
			props: (route) => ({
				page: route.query.page,
				tab: route.query.tab || "graph"
			}),
			components: { default: Graph, tab: Navigation },
		},
		{
			path: "/wp-admin/admin.php",
			name: "settings",
			props: (route) => ({
				page: route.query.page,
				tab: route.query.tab || "settings"
			}),
			components: { default: Settings, tab: Navigation },
		},
	];

	const router = createRouter({
	history: createWebHistory(),
	routes,
	});

	export default router;
</script>