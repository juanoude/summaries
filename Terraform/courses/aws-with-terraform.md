# Intro
### What is Terraform?
Terraform is a tool to construct, modify and create infrastructure versions with safety and efficiency through code.
* Infrastructure as code (IaC)
* Open Source
* Has versioning
	* Leverages automation and evolution for the infrastructure;
	* Either create or alter, it would never create the same resource twice;
* It is agnostic
	* It works on AWS / GCP / Azure
	* It can deploy to multiple servers simultaneously

### How Terraform works?
* **Terraform Core** - which has two inputs:
	* Configuration Files (desired state).
	* The actual state, which is managed by Terraform.
* **Providers** - The providers expose some resources, this allows the creation of infrastructure in all platforms
	* IaaS - AWS, GCP, Azure.
	* PaaS - Kubernetes, Heroku, Digital Ocean.
	* SaaS - New Relic, Datadog.

-----
**Terraform is a high level tool to orquestrate infrastructure. It does NOT manage configuration**
🚫 Diferent than Ansible, Puppet, Chef and other tools to manage config 🚫
*Some providers allow those tools along with Terraform*

Terraform has other IaaS competitors like CloudFormation. The difference is that those tools only offer support to specific vendors. None of them are agnostic.
<!--stackedit_data:
eyJoaXN0b3J5IjpbMTAzOTE2NTk5MSwtMTgxMzQ4MTg4MywtMT
g3NTE4ODMzN119
-->