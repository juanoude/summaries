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

**Course source code**: https://github.com/chgasparoto/curso-aws-com-terraform

# Installation
**Normal Installation** -> [here](https://developer.hashicorp.com/terraform/install?product_intent=terraform)
**Version Manager** -> [here](https://github.com/tfutils/tfenv)
To automatically change terraform versions you just need to create a `.terraform-version` file inside the folder with the version inside, for example, `0.6.16`. *(With version manager only)*

After the installation. You should create an user in AWS with programatic access and configure a profile in the CLI:
```bash
aws configure --profile "terraform"
```

# Terraform Basics
### Terraform CLI
```bash
terraform -h
terraform <subcommand> -h
```
Basic help command, can be called with a subcommand too as demonstrated in the second line

### Docs
The official providers docs can be found [here](https://registry.terraform.io/browse/providers?product_intent=terraform)


<!--stackedit_data:
eyJoaXN0b3J5IjpbOTIxODA1NDI2LDEyMjkxMTAyOCwxMDk3MT
Q1ODgzLC0xODc5Mjk2NTIsNTY3MzQ0MDMzLC0xODEzNDgxODgz
LC0xODc1MTg4MzM3XX0=
-->