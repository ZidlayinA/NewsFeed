module.exports = {
	globDirectory: 'admin/',
	globPatterns: [
		'**/*.{php,png,html,json,js}'
	],
	swDest: 'admin/sw.js',
	ignoreURLParametersMatching: [
		/^utm_/,
		/^fbclid$/
	]
};