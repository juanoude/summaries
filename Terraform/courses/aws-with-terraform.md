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

### Provider
The official providers docs can be found -> [here](https://registry.terraform.io/browse/providers?product_intent=terraform)

The aws specific docs can be found -> [here](https://registry.terraform.io/providers/hashicorp/aws/latest/docs)

For our first script lets begin by creating a `main.tf` file with the following content:
```hcl
provider "aws" {
	region = "us-east-1"
	profile = "terraform" //cli user profile
}

resource "aws_s3_bucket" "my-test-bucket" {
  bucket = "my-tf-test-bucket-1241451251225"

  tags = {
    Name        = "My bucket"
    Environment = "Dev"
    ManagedBy   = "Terraform"
  }
}
```
Then run the `terraform init` command in the .tf file folder. It will download all the dependencies, a lock file and a folder with all provider files.

After that you can run a `terraform plan`. This will show you a summary of all the operations to be made once you apply the infrastructure.

After you review all the plan output, you can simply run `terraform apply`. This will output the plan again and ask for a confirmation. Just type `yes`and the bucket will be created successfully.

To specify the versions you can add the following to the script:
```hcl
terraform {
	required_version = "1.6.6"

	required_providers {
		aws = {
			source = "hashicorp/aws"
			version = "5.31.0"
		}
	}
}
```
### Modifications
Once we modify the configuration file the infrascructure will be updated accordingly. Let's add two new tags:
```hcl
	Owner = "Juan Ananda"
	UpdatedAt = "2024-01-08"
```
Let's run `terraform plan -out="tfplan.out"` to see the structure changes and output it in a file. You will see in the summary some bucket updates.

Now to apply we should run `terraform apply "tfplan.out"`. And the proper updates should happen.

Now if we alter the bucket name and execute the same steps. You should see an planned resource destruction and the creation of a new one.

Now if you run the command `terraform destroy`. A summary of the destroyed resources will appear and all of them will be deleted after your confirmation.

Other useful commands are 
* `terraform validate` - This will check if the configuration is valid.
* `terraform fmt` - This will format the file according with terraform standards.

### Variables

<!--stackedit_data:
eyJoaXN0b3J5IjpbNTgwMjY1MTc2LDEyMjkxMTAyOCwxMDk3MT
Q1ODgzLC0xODc5Mjk2NTIsNTY3MzQ0MDMzLC0xODEzNDgxODgz
LC0xODc1MTg4MzM3XX0=
-->