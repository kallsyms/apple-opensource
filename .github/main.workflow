workflow "Update sources" {
  resolves = ["update"]
  on = "schedule(0 0 * * *)"
}

action "update" {
  uses = "./"
  secrets = ["GITHUB_TOKEN"]
}
