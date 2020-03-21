// axios instance
const apiClient = axios.create({
	baseURL: `${process.env.MIX_APP_URL}/api/v1/vogels`,
	headers: {
		Accept: "application/json",
		"Content-Type": "application/json"
	}
})

export default {
	// Get data for reports
	getBirds() {
		return apiClient.get("data")
	},
	// Get report information
	getInfo() {
		return apiClient.get("info")
	},

	// Send a report by email
	sendReport(data) {
		return apiClient.post("report", data)
	}
}
